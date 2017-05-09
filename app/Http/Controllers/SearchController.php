<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Song;
use App\User;

class SearchController extends Controller
{


    public function show(){

        $array = array();
        $f = array();
        return view('searcher',array('busqueda'=>$array,'filtro'=>"cancion",'followers'=>$f));
    }

    public function search(Request $request){
        $follow = array();
        if($request->filtro=="cancion"){
            $result = DB::table('songs')->where('title','=',$request->busqueda)->paginate(3);
        }
        if($request->filtro=="usuario"){
            $result = DB::table('users')->where('nick','=',$request->busqueda)->paginate(3);
            
            for($i=0;$i<sizeof($result);$i++){
                $bool = $this->followers($result[$i]->id);
                if($bool==true){
                    $follow[$i] = 1;
                }else{
                    $follow[$i] = 0;
                }
            }
        }

        return view('searcher',array('busqueda'=>$result,'filtro'=>$request->filtro,'followers'=>$follow));
    }

    public function followers($user){
        $res = DB::table('user_user')->where('user_id1','=',Auth::user()->id)->where('user_id2','=',$user)->count();
        if($res!=0){
            return true;
        }else{
            return false;
        }
    }
}
