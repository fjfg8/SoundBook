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

        $song = Song::find($request->song);
        $user = User::find(Auth::user()->id);
        $c = new Comment();
        $c->comment = $request->comentario;
        $c->user()->associate($user);
        $c->song()->associate($song);

        $c->save();

        return redirect()->action('SongsController@show',$request->song);
    }

    public function edit(Request $request){
        $this->validate($request,[
            'comentario'=>'required',
        ]);

        $c = Comment::find($request->comment_id);
        $c->comment = $request->comentario;
        $c->save();

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
        $comment = Comment::find($request->comment);
        $comment->delete();

        return redirect()->back();
    }
}
