<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    
 
    public function song(){
        return $this->belongsTo('App\Song');
    }

     public function user(){
        return $this->belongsTo('App\User');
    }

    public function users_likes(){
        return $this->belongsToMany('App\User','comment_user','comment_id','user_id');
    }

    public static function getLikes($comm){
        return $comm->users_likes()->count();
    }

    public static function userLike($comm){
        return $comm->users_likes()->where('user_id','=',Auth::user()->id)->count();
    }
}
