<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Song;
use App\Comment;
use App\User;
use App\Type;
use Illuminate\Support\Facades\Auth;
class SongsController extends Controller
{
    public function show($id){
    
        $song = Song::buscar($id);
        $user_id = $song->user_id;
        $user = User::search($user_id);
        $types = Type::getTypes();
        $comments = $song->getComments();
        $count = $song->comments()->count();
        $users = User::getAll();
        //proceso para controlar los likes y si ya le hemos dado like a la cancion
        $likesSong = Song::getLikes($song);
        $likedSong = false;
        if(Song::userLike($song) == 1){
            $likedSong = true;
        }
        ////////

        //proceso para controlar los likes y si ya le hemos dado like a un comentario
        $likesComm = array();
        $likedComm = array();
        $i=0;
        foreach($comments as $c){
            $likesComm[$i] = Comment::getLikes($c);
            $aux = false;
            if(Comment::userLike($c) == 1){
                $aux = true;
            }
            $likedComm[$i] = $aux;
            $i++;
        }
        ////////
        
        return view('song',array('user' => $user,'song' => $song,'comments'=>$comments,'types'=>$types,'count'=>$count,'users'=>$users,
         'likesSong'=>$likesSong, 'likedSong'=>$likedSong,'likesComm'=>$likesComm,'likedComm'=>$likedComm,'i'=>0));
    }

    public function create(Request $request){

        $this->validate($request,[
            'title'=>'required',
            'artist'=>'required',
            'album'=>'required',
            'gender'=>'required',
            'date'=>'required'
        ]);

        $s = new Song();
        $user = User::find(Auth::user()->id);
        $s->create($request, $user);

        return redirect()->action('HomeController@index');
    }

    public function delete(Request $request){
        $s = Song::buscar($request->song);
        $s->delete();

        return redirect()->action('HomeController@index');
    }

    public function edit(Request $request){

        $s = Song::buscar($request->id);

        $s->edit($request);

        return redirect()->back();
    }

    public function like(Request $request){
        $song = Song::buscar($request->id);
        $user = User::search(Auth::user()->id);
        //$song->likes = $song->likes + 1;
        $song->users_likes()->attach($user->id);
        //$song->save();

        return redirect()->back();
    }
}
