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
    
        $song = Song::findOrFail($id);
        $user_id = $song->user_id;
        $user = User::find($user_id);
        $types = Type::all();
        $comments = $song->comments()->orderby('created_at','desc')->paginate(5);
        $count = $song->comments()->count();
        
        return view('song',array('user' => $user,'song' => $song,'comments'=>$comments,'types'=>$types,'count'=>$count));
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
        $s->title = $request->title;
        $s->artist = $request->artist;
        $s->album = $request->album;
        $s->likes = 0;
        $s->date = $request->date;
        $s->url = $request->url;
        $user = User::find(Auth::user()->id);
        $s->user()->associate($user);
        $type = Type::where('type','=',$request->gender)->first();
        $s->type()->associate($type);

        $s->save();

        return redirect()->action('HomeController@index');
    }

    public function delete(Request $request){
        $s = Song::find($request->song);
        $s->delete();

        return redirect()->action('HomeController@index');
    }

    public function edit(Request $request){

        $s = Song::findOrFail($request->id);

        if($request->has('title')){
            $s->title = $request->title;
           
        }
        if($request->has('artist')){
            $s->artist = $request->artist;
        }
        if($request->has('type_id')){
            $s->type_id = $request->type_id;
        }
        if($request->has('date')){
            $s->date = $request->date;
        }
        if($request->has('album')){
            $s->album = $request->album;
        }
        if($request->has('url')){
            $s->url = $request->url;
        }
        if($request->has('date')){
            $s->date = $request->date;
        }


         $s->save();

        $request->session()->put([
            'filtro'=>"fecha"
        ]);

        return redirect()->back();
    }

    public function like(Request $request){
        $song = Song::find($request->id);
        $song->likes = $song->likes + 1;

        $song->save();

        return redirect()->back();
    }
}
