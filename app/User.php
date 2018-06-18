<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\File;
use App\Folder;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function files(){
      return $this->hasMany('App\File');
    }

    public function folders(){
      return $this->hasMany('App\Folder');
    }

    public function sharedFiles(){
      return $this->belongsToMany('App\File');
    }

    public function sharedFolders(){
      return $this->belongsToMany('App\Folder');
    }

    public function friends(){
      return $this->belongsToMany('App\User', 'user_user', 'user1_id', 'user2_id');
    }

    public function tasks(){
      return $this->hasMany('App\Task');
    }
}
