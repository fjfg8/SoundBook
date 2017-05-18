<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Song;
use App\User;

class WallController extends Controller
{
    public function show(){
        $result = $this->publicaciones();

       // $users = User::find(Auth::user()->id);
       $users = array();
        for($i=0;$i<sizeof($result);$i++){
            $users[$i] = User::find($result[$i]->user_id);
        }

        /*foreach($result as $r){
            $aux = User::find($r->user_id);
            $users = $users->merge($aux);
        }*/


        return view('wall',array('songs' => $result,'users'=>$users));
    }

    public function publicaciones(){
        $user = User::find(Auth::user()->id);

        $others = $user->users; 
        $songs = $user->songs;
        
        foreach($others as $o){
            $aux = $o->songs;
            $songs = $songs->merge($aux);
        }

        return $songs;
    }

}
