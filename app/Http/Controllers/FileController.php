<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\File;
use App\Folder;
use App\User;
use finfo;

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
        $folder = Folder::find(session()->get('currentFolder'));
        if($folder->user_id == $user->id || $user->sharedFolders()->findOrFail($folder->id)) return view('users.files.create',compact('user'));
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
        $clientFile = $request->file('file');
        $user = Auth::user();
        $pFolder = Folder::find(session()->get('currentFolder'));
        if ($clientFile->getClientSize() > 104857600) return "file too big";

        if($pFolder->user_id == $user->id || $user->sharedFolders()->findOrFail($pFolder->id)){
          //if(!preg_match('/\.\.*/', $clientFile->getClientOriginalName()) && !preg_match('/\//', $clientFile->getClientOriginalName())){
            $file = new File();
            $file->name = $clientFile->getClientOriginalName();
            $file->user_id = $pFolder->user_id;
            $file->folder_id = $request->session()->get('currentFolder');
            $file->save();

            $path = Folder::find($file->folder_id)->getPath();

            $encFile = Crypt::encrypt(file_get_contents($clientFile));

            file_put_contents($clientFile, $encFile);

            Storage::disk('local')->putFileAs('storage/'.User::find($pFolder->user_id)->name.'/'.$path, $clientFile,$file->name);

            return redirect('/user/folders/'.$file->folder_id);
          //}else return "filename problem";
        }else return "user problem";
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
       $user = Auth::user();
       if($file->user_id == $user->id || $user->sharedFiles()->findOrFail($id)) return view('users.files.show', compact('file','user'));
       else return redirect('/user/folders/');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return redirect('/user/folders/');
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
      $file = Storage::disk('local')->get('storage/'.Auth::user()->name.$path);
      $decryptedContents = Crypt::decrypt($file);

      return response()->make($decryptedContents, 200, array(
          'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($decryptedContents),
          'Content-Disposition' => 'attachment; filename="' . pathinfo($path, PATHINFO_BASENAME) . '"'
      ));
    }

    public function share($id)
    {
      $file = File::find($id);
      $user = Auth::user();
      return view('users.files.share', compact('file','user'));
    }

    public function shareWith(Request $request){
      $targetUser = User::where('name', $request->name)->first();
      return $targetUser->sharedFiles()->save(File::find($request->fileID));

    }

    public function showMySharedFiles(){
      $user = Auth::user();
      $files = $user->sharedFiles;
      return view('users.files.showSharedFiles',compact('user','files'));

    }

    public function fav($id){
      $user = Auth::user();
      $file = $user->files()->find($id);
      if($file->favorite) $file->update(['favorite' => 0]);
      else $file->update(['favorite' => 1]);
    }
}
