<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'UserController@index');
Route::resource('/user/files', 'FileController');
Route::resource('/user/folders', 'FolderController');
Route::get('user/files/dl/{id}', 'FileController@downloadFile');
Route::get('/user/profile', 'UserController@show');
Route::get('/user/photo/{id}', 'UserController@profilePhoto');
Route::delete('/user/delete', 'UserController@destroy');
Route::get('/user/edit', 'UserController@edit');
Route::put('/user/update', 'UserController@update');
Route::get('/user/file/share/{id}', 'FileController@share');
Route::post('/user/file/shareFile/', 'FileController@shareWith');
Route::get('/user/file/shared', 'FileController@showMySharedFiles');
Route::get('/user/folder/share/{id}', 'FolderController@share');
Route::post('/user/folder/shareFolder/', 'FolderController@shareWith');
Route::get('/user/folder/shared', 'FolderController@showMySharedFolders');
Route::get('/friends', 'UserController@showMyFriends');
Route::get('/friends/add', 'UserController@addFriend');
Route::post('/friends/store', 'UserController@storeFriend');
Route::delete('/friend/delete', 'UserController@deleteFriend');
Route::resource('/tasks', 'TasksController');
Route::delete('/user/folders/fav/{id}', 'FolderController@fav');
