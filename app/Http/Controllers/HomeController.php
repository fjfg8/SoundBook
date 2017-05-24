<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Song;
use App\Type;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Auth::user();
        $types = Type::getTypes();

        $generos = [
            "Mujer" => "Mujer",
            "Hombre" => "Hombre",
            "Prefiero no decirlo" => "Prefiero no decirlo",
        ];

        $estados = [
            "Soltero/a" => "Soltero/a",
            "Comprometido/a" => "Comprometido/a",
            "Casado/a" => "Casado/a",
            "Divorciado/a" => "Divorciado/a",
            "Viudo/a" => "Viudo/a",
            "Prefiero no decirlo" => "Prefiero no decirlo",
        ];

        $filters = [
            "Titulo" => "Titulo",
            "Fecha" => "Fecha",
            "Artista" => "Artista",
        ];

        $filtro = "Fecha";

        if(session()->has("filtro")){
            $filtro = session()->get('filtro'); 
        }
        session()->put([
            'filtro'=> $filtro,
        ]);

        return view('home',array('user' => $user,
        'songs'=>Song::search($user->id,$filtro),
        'follow'=>User::follow($user->id),'followers'=>User::followers($user->id), 
            'types'=>$types, 'generos'=>$generos, 'filters'=>$filters, 'estados'=>$estados));
    }

    public function visitProfile($id){
        if(Auth::user()->id != $id){
            $user = User::search($id);
            $songs = User::getSongs($user);
            $follow = User::follow($user->id);
            $followers = User::followers($user->id);
            $bool = User::followProfile($user->id);

            return view('user',array('user' => $user,'songs'=>$songs,'follow'=>$follow,'followers'=>$followers,'bool'=>$bool));
        }
        else{
            return redirect()->action('HomeController@index');
        }
    }

    public function showFollow(){
        $users = User::getFollow(Auth::user());
        
        return view('following',array('users'=>$users));
    }

    public function showFollowers(){
        $ids = User::getFollowers(Auth::user());
        $users = array();
        if(sizeof($ids)==0){
            return view('followers',array('users'=>$users));
        }else{
            for($i=0;$i<sizeof($ids);$i++){
                $aux = User::search($ids[$i]->user_id1);
                $users[$i]=$aux;
            }
        }
        return view('followers',array('users'=>$users));
    }


}
