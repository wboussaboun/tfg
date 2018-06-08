<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Folder;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth');
     }


    public function index()
    {
      $user = Auth::user();
      $folder = Folder::where('name', $user->name)->first();
      return view('users.folders.show', compact('user','folder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      return view('users.folders.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $folder = new Folder();
      $folder->name = $request->name;
      $folder->user_id = Auth::id();
      $folder->folder_id = $request->session()->get('currentFolder');
      $folder->save();

      $path = $folder->getPath();
      Storage::disk('local')->makeDirectory('storage/'.Auth::user()->name.'/'.$path);

      return redirect('/user/folders/'.$folder->folder_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $id=intval($id);
      $folder = Folder::find($id);
      $user = Auth::user();
      if($folder->user_id == $user->id){
        session(['currentFolder' => $id]);
        return view('users.folders.show', compact('user','folder'));
      }
      else return redirect('/user/folders');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $folder = Folder::find($id);
        return view('users.folders.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $folder = Folder::find($id);
        $oldPath = 'storage/'.Auth::user()->name.'/'.$folder->getPath();
        $folder->update(['name' => ''.$request->name]);
        $newPath = 'storage/'.Auth::user()->name.'/'.$folder->getPath();
        Storage::move( $oldPath, $newPath);
        return redirect($newPath);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $id=intval($id);
      $folder = Folder::find($id);
      $path = $folder->getPath();
      $user = Auth::user();
      if($folder->user_id == $user->id){
        $folder->delete();
        Storage::disk('local')->deleteDirectory('storage/'.Auth::user()->name.'/'.$path);
        return "cool";
      } return "not cool";
    }
}