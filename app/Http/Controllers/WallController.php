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
    $id = Auth::user()->id;

    $users = DB::table('user_user')->select('user_id2')->where('user_id1','=',$id)->paginate(5);

    $publi = array();
    foreach($users as $u){
       
        $res = Song::where('user_id','=',$u);
        $publi = array_merge($publi,(array)$res);
    }
    $aux = Song::where('user_id','=',Auth::user()->id);
    $publi = array_merge($publi,(array)$aux);

    //uasort($publi,'cmp');
    return $publi;
    }

    public function cmp($a, $b) {
        if ($a->created_at == $b->created_at) {
            return 0;
        }
        return ($a->created_at < $b->created_at) ? -1 : 1;
    }

}
