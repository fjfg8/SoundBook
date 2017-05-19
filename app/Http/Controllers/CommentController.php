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
            'descripcion'=>'required',
        ]);

        $song = Song::find($request->song);
        $user = User::find(Auth::user()->id);
        $c = new Comment();
        $c->comment = $request->descripcion;
        $c->likes = 0;
        $c->user()->associate($user);
        $c->song()->associate($song);

        $c->save();

    return redirect()->action('SongsController@show',$request->song);
    }

    public function edit(Request $request){
        
        $c = Comment::find($request->comment);
        $c->comment = $request->descripcion;
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
