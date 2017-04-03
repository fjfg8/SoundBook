<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Song;
use App\Comment;
use App\User;
class SongsController extends Controller
{
    public function show($id){
        $song = Song::findOrFail($id);
        //$comments = Comment::select()->where('song_id','=',$id)->orderby('created_at','desc')->paginate(3);
        $comments = DB::table('comments')
        ->join('users','comments.user_id','=','users.id')
        ->select('comments.*','users.nick')->paginate(3);
        return view('song',array('song' => $song,'comments'=>$comments));
    }

    public function create(Request $request){

        $this->validate($request,[
            'title'=>'required',
            'artist'=>'required',
            'duration'=>'required',
            'gender'=>'required',
            'date'=>'required'
        ]);

        $s = new Song();
        $s->title = $request->title;
        $s->artist = $request->artist;
        $s->duration = $request->duration;
        $s->gender = $request->gender;
        $s->date = $request->date;
        $s->user_id = $request->user;

        $s->save();

        return redirect()->action('UsersController@show',$request->user);

    }
}
