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

    public function create($request, $user) {
                
        $this->title = $request->title;
        $this->artist = $request->artist;
        $this->album = $request->album;
        $this->date = $request->date;
        $this->url = $request->url;
        $this->user()->associate($user);
        $type = Type::getTypeStyle($request->gender)->first();
        $this->type()->associate($type);

        $this->save();

    }

    public static function buscar($id) {
        return Song::find($id);
    }

    public function edit($request) {
        if($request->has('title')){
            $this->title = $request->title;
           
        }
        if($request->has('artist')){
            $this->artist = $request->artist;
        }
        if($request->has('type_id')){
            $this->type_id = $request->type_id;
        }
        if($request->has('date')){
            $this->date = $request->date;
        }
        if($request->has('album')){
            $this->album = $request->album;
        }
        if($request->has('url')){
            $this->url = $request->url;
        }
        if($request->has('date')){
            $this->date = $request->date;
        }


         $this->save();

        $request->session()->put([
            'filtro'=>"Fecha"
        ]);
    }

    public function getComments() {
        return $this->comments()->orderby('created_at','desc')->paginate(5);
    }
    
}
