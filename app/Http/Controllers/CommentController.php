<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Song;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function create(Request $request){
        $this->validate($request,[
            'comentario'=>'required',
        ]);

        $song = Song::buscar($request->song);
        $user = User::search(Auth::user()->id);
        $c = new Comment();
        $c->create($request, $user, $song);

        return redirect()->action('SongsController@show',$request->song);
    }

    public function edit(Request $request){
        $this->validate($request,[
            'comentario'=>'required',
        ]);

        Comment::edit($request);

        return redirect()->action('SongsController@show',$request->song);
    }

    public function like(Request $request){
     
     $c = Comment::findOrFail($request->comment);
     $user = User::find(Auth::user()->id);
    
    //$c->likes = $c->likes + 1;
     //$c->save();
     $c->users_likes()->attach($user->id);

     return redirect()->action('SongsController@show',$request->song);

    }

    public function userName($user){
        $name = Song::select('name')->where('id','=',$user)->first();
        return $name;

    }

    public function delete(Request $request){
        Comment::borrar($request);

        return redirect()->back();
    }
}
