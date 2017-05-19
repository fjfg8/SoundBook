<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Song;
use App\User;
use App\Type;

class WallController extends Controller
{
    public function show(){
        $result = $this->publicaciones();
        $users = array();
        $types = Type::all();
        
       /* for($i=0;$i<sizeof($result);$i++){
            $users[$i] = User::find($result[$i]->user_id);
        }*/
        $i=0;
        foreach($result as $r){
            $users[$i] = User::find($r->user_id);
            $i++;
        }

        return view('wall',array('songs' => $result,'users'=>$users,'i'=>0, 'types'=>$types));
    }

    public function publicaciones(){
        $user = User::find(Auth::user()->id);

        $others = $user->users; 
        $songs = $user->songs;
        
        foreach($others as $o){
            $aux = $o->songs;
            $songs = $songs->merge($aux);
        }
        $aux2 = $songs->sortByDesc('created_at');

        return $aux2;
    }

}
