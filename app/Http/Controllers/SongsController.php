<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Comment;
class SongsController extends Controller
{
    public function show($id){
        $song = Song::findOrFail($id);
        $comments = Comment::where('song_id','=',$id)->paginate(5);
        return view('song',array('song' => $song,'comments'=>$comments));
    }


    /*public function like(Request $request){
    
        $c = Comment::findOrFail($request->comment);

        $c->likes = $c->likes + 1;
        $c->save();

        return redirect()->action('SongsController@show',$request->song);

    }*/
}
