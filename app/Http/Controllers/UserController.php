<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
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

        session(['currentFolder' => Folder::where('name', $user->name)->first()->id]);
        return view('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //NOT NEEDED
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //NOT NEEDED
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      $user = Auth::user();
      return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $user = Auth::user();
      $file = $request->file('file');

      if ($file!=null){

        $user->update(['name' => ''.$request->name,'profile_photo' => ''.$file->getClientOriginalName()]);
        Storage::disk('local')->putFileAs('Profile/'.Auth::user()->id, $file,$file->getClientOriginalName());
      }else {
        $user->update(['name' => ''.$request->name]);
      }



      return view('users.index', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        Storage::disk('local')->deleteDirectory('Profile/'.Auth::user()->id);
        $user->files()->delete();
        $user->folders()->delete();
        $user->delete();
        return view('/');
    }

    public function profilePhoto($id){
      return response()->download(storage_path('app/Profile/'.Auth::user()->id.'/'.Auth::user()->profile_photo));
    }

    public function showMyFriends(){
      $user = Auth::user();
      return view('users.friends.show', compact('user'));
    }
    public function addFriend(){
      $user = Auth::user();
      return view('users.friends.create', compact('user'));
    }

    public function storeFriend(Request $request){
      $friend = User::where('name',$request->name)->first();
      Auth::user()->friends()->save($friend);
      $user = Auth::user();
      return view('users.friends.show', compact('user'));
    }

    public function deleteFriend($id)
    {//asegurarse de esto
        $user = Auth::user();
        $user->friends->find($id)->detach();
    }


}
