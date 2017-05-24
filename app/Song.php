<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Song extends Model
{

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function publications(){
        return $this->hasMany('App\Publication');
    }
    public function type(){
        return $this->belongsTo('App\Type');
    }
    public function users_likes(){
        return $this->belongsToMany('App\User','song_user','song_id','user_id');
    }

    public static function search($id,$filtro){
        if($filtro == "Fecha")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('date','asc')->paginate(4);

        if($filtro == "Titulo")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('title','asc')->paginate(4);
            
        if($filtro == "Artista")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('artist','asc')->paginate(4);
         
         return 
         $songs;
    }

    public static function getLikes($song){
        return $song->users_likes()->count();
    }

    public static function userLike($song){
        return $song->users_likes()->where('user_id','=',Auth::user()->id)->count();
    }

    
}
