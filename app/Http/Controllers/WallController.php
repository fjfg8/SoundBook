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
        return view('wall',array('publi' => $result));
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
