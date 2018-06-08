<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
  protected $fillable = [
    'name',
    'path',
    'folder_id',
    'user_id'
  ];

  public function childFiles(){
    return $this->hasMany('App\File');
  }

  public function childFolders(){
    return $this->hasMany('App\Folder');
  }
  public function owner(){
    return $this->belongsTo('App\User');
  }

  public function parentFolder(){
    return $this->belongsTo('App\Folder');
  }

  public function getPath(){
    if($this->folder_id==null) return "";
    else return Folder::find($this->folder_id)->getPath().'/'.$this->name;
  }

  public function isOwner($id){
    return $id==$this->id;
  }
}
