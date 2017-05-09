<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Song;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;
class SongsController extends Controller
{
    public function show($id){
        $song = Song::findOrFail($id);
        //$comments = Comment::select()->where('song_id','=',$id)->orderby('created_at','desc')->paginate(3);
        /*$comments = DB::table('comments')
        ->join('users','comments.user_id','=','users.id')
        ->where('comments.song_id','=',$id)
        ->select('comments.*','users.nick')
        ->orderBy('created_at','desc')->paginate(3);*/
        $comments = $song->comments()->orderby('created_at','desc')->paginate(3);
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
        $s->user_id = Auth::user()->id;

        $s->save();

        return redirect()->action('HomeController@index');
    }

    public function delete(Request $request){
        $s = Song::find($request->song);
        $s->delete();

        return redirect()->back();
    }

    public function edit(Request $request){

        $s = Song::findOrFail($request->id);

        if($request->has('title')){
            $s->title = $request->title;
            $s->save();
        }
        if($request->has('artist')){
            $s->artist = $request->artist;
            $s->save();
        }
        if($request->has('gender')){
            $s->gender = $request->gender;
            $s->save();
        }
        if($request->has('duration')){
            $s->duration = $request->duration;
            $s->save();
        }
        if($request->has('date')){
            $s->date = $request->date;
            $s->save();
        }

            $request->session()->put([
                'filtro'=>"fecha"
            ]);

        return redirect()->action('HomeController@index');
    }
}
