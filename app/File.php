<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Folder;

class File extends Model
{
    protected $fillable = [
      'name',
      'path',
      'folder_id',
      'user_id',
      'favorite'
    ];

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

    public function sharedWith(){
      return $this->belongsToMany('App\User');
    }
}
