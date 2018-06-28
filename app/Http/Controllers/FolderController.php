<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Folder;
use App\User;

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
      $folder = Folder::find(session()->get('currentFolder'));
      if($folder->user_id == $user->id || $user->sharedFolders()->findOrFail($folder->id)) return view('users.folders.create',compact('user'));
      else return redirect('/user/folders/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = Auth::user();
      $pFolder = Folder::find(session()->get('currentFolder'));
      if($pFolder->user_id == $user->id || $user->sharedFolders()->findOrFail($pFolder->id)){
        if(!preg_match('/\.\.*/', $request->name) && !preg_match('/\//', $request->name)){
          $folder = new Folder();
          $folder->name = $request->name;
          $folder->user_id = $pFolder->user_id;
          $folder->folder_id = $request->session()->get('currentFolder');
          $folder->save();

          $path = $folder->getPath();
          Storage::disk('local')->makeDirectory('storage/'.User::find($pFolder->user_id)->name.'/'.$path);

          return redirect('/user/folders/'.$folder->folder_id);
        }
        else return redirect('/user/folders/create');
      }else return redirect('/user/folders/');


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
      if($folder->user_id == $user->id || $user->sharedFolders()->findOrFail($id)){
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
        if($folder->user_id == $user->id || $user->sharedFolders()->find($id)->size()>0){
          return view('users.folders.edit', compact('folder'));
        }else return redirect('/user/folders');
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
      $user = Auth::user();
      $folder = Folder::find($id);
      if($user->id==$folder->user_id){
        $oldPath = 'storage/'.$user->name.'/'.$folder->getPath();
        $folder->update(['name' => ''.$request->name]);
        $newPath = 'storage/'.$user->name.'/'.$folder->getPath();
        Storage::move( $oldPath, $newPath);
        return redirect('user/folders/'.$folder->id);
      }else return redirect('user/folders');
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

    public function share($id)
    {
      $folder = Folder::find($id);
      $user = Auth::user();
      if($user->id==$folder->user_id) return view('users.folders.share', compact('folder','user'));
      else return redirect('user/folders');

    }

    public function shareWith(Request $request){//rehacer, recursividad?

      $user = Auth::user();
      $targetUser = User::where('name', $request->whom)->first();

      $folder = Folder::find($request->id);

      if($user->id==$folder->user_id){
        $targetUser->sharedFolders()->save($folder);

        foreach ($folder->childFolders as $cFolder) {
          $targetUser->sharedFolders()->save($cFolder);
        }

        foreach ($folder->childFiles as $cFile) {
          $targetUser->sharedFiles()->save($cFile);
        }
        return 'succ';
      }else return 'no succ';


    }

    public function showMySharedFolders(){
      $user = Auth::user();
      $folders = $user->sharedFolders;
      return view('users.folders.showSharedFolders',compact('user','folders'));

    }

    public function fav($id){
      $user = Auth::user();
      $folder = $user->folders()->find($id);
      if($user->id==$folder->user_id){
        if($folder->favorite) $folder->update(['favorite' => 0]);
        else $folder->update(['favorite' => 1]);
      }
    }
}
