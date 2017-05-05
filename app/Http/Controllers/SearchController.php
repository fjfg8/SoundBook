<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Song;
use App\User;

class SearchController extends Controller
{


    public function show(){

        $array = array();
        return view('searcher',array('busqueda'=>$array,'filtro'=>"cancion"));
    }

    public function search(Request $request){
        $result=null;
        if($request->filtro=="cancion"){
            $result = DB::table('songs')->where('title','=',$request->busqueda)->paginate(3);
        }else{//if($request->filtro=="usuario"){
            $result = DB::table('users')->where('nick','=',$request->busqueda)->paginate(3);
        }

        return view('searcher',array('busqueda'=>$result,'filtro'=>$request->filtro));
    }
}
