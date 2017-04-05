<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Song;

class CommentController extends Controller
{

    public function create(Request $request){
        
        $c = new Comment();
        $c->comment = $request->descripcion;
        $c->likes = 0;
        $c->user_id = session()->get('id');
        $c->song_id = $request->song;

        $c->save();

    return redirect()->action('SongsController@show',$request->song);
    }

    public function like(Request $request){
     
     $c = Comment::findOrFail($request->comment);

     $c->likes = $c->likes + 1;
     $c->save();

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
