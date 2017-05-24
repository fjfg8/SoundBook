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
        $result = User::publicaciones();
        $users = array();
        $likes = array();
        $liked = array();
        $types = Type::getTypes();
       
        $i=0;
        foreach($result as $r){
            $users[$i] = User::search($r->user_id);
            $likes[$i] = Song::getLikes($r);

            //proceso para controlar si ya le hemos dado like a la cancion
            $aux = false;
            if(Song::userLike($r) == 1){
                $aux = true;
            }
            $liked[$i] = $aux;
            ////////

            $i++;
        }
        

        return view('wall',array('songs' => $result,'users'=>$users,'i'=>0, 'types'=>$types, 'likes'=>$likes, 'liked'=>$liked));
    }

}
