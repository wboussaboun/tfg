<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\File;
use App\Folder;

class FileController extends Controller
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
        return view('users.files.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('users.files.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientFile = $request->file('file');


        $file = new File();
        $file->name = $clientFile->getClientOriginalName();
        $file->user_id = Auth::id();
        $file->folder_id = $request->session()->get('currentFolder');
        $file->save();

        $path = Folder::find($file->folder_id)->getPath();

        Storage::disk('local')->putFileAs('storage/'.Auth::user()->name.'/'.$path, $clientFile,$file->name);
        return redirect('/user/folders/'.$file->folder_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $file = File::find($id);
      return view('users.files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('users.files.edit');
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
      $file = File::find($id);
      $path = $file->getPath();
      $user = Auth::user();
      if($file->user_id == $user->id){
        $file->delete();
        Storage::disk('local')->delete('storage/'.Auth::user()->name.'/'.$path);
        return "cool";
      } return "not cool";
    }

    public function downloadFile($id)
    {
      $path = File::find($id)->getPath();
      return response()->download(storage_path("app/".'storage/'.Auth::user()->name.$path));


    }


}
