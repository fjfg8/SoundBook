<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use App\Account;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


   /* private $id;
    private $email;
    private $password;
    private $gender;
    private $status;
    private $preferences;
    private $admin;*/

   public function songs(){
        return $this->hasMany('App\Song');
    }
   public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function groups(){
        return $this->belongsToMany('App\Group');
    }

    public function users(){
        return $this->belongsToMany('App\User','user_user','user_id1','user_id2');
    }

    public function songs_likes(){
        return $this->belongsToMany('App\Song','song_user','song_id','user_id');
    }

    public function comments_likes(){
        return $this->belongsToMany('App\Comment','comment_user','comment_id','user_id');
    }

}
