<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use App\Comment;
class SongsController extends Controller
{
    public function show($id){
        $song = Song::findOrFail($id);
        $comments = Comment::where('song_id','=',$id)->get();
        return view('song',array('song' => $song,'comments'=>$comments));
    }
}
