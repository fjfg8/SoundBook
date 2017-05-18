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
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $types = Type::all();

        $generos = [
            "Chica" => "Chica",
            "Chico" => "Chico",
            "Prefiero no decirlo" => "Prefiero no decirlo",
        ];

        $filters = [
            "Titulo" => "Titulo",
            "Fecha" => "Fecha",
            "Artista" => "Artista",
        ];

        if(session()->has("filtro")){
            $filtro = session()->get('filtro'); 
        }else{
            $filtro = "Fecha";
        }

        if($filtro == "Titulo")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('title','asc')->paginate(4);

        if($filtro == "Fecha")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('date','asc')->paginate(4);

        if($filtro == "Artista")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('artist','asc')->paginate(4);
            
        session()->put([
            'filtro'=> $filtro,
        ]);

        $follow = $this->follow(Auth::user()->id);
        $followers = $this->followers(Auth::user()->id);
        return view('home',array('user' => $user,'songs'=>$songs,'follow'=>$follow,'followers'=>$followers, 'types'=>$types, 'generos'=>$generos, 'filters'=>$filters));
    }

    public function visitProfile($id){
        $user = User::find($id);
        $songs = $user->songs()->paginate(4);
        $follow = $this->follow($user->id);
        $followers = $this->followers($user->id);
        $bool = $this->followProfile($user->id);

        return view('user',array('user' => $user,'songs'=>$songs,'follow'=>$follow,'followers'=>$followers,'bool'=>$bool));
    }

    public function followProfile($id){
        $res = DB::table('user_user')->where('user_id1','=',Auth::user()->id)->where('user_id2','=',$id)->count(); 
        if($res==1){
            return true;
        }else{
            return false;
        }
    }



    public function follow($id){
        $res = DB::table('user_user')->where('user_id1','=',$id)->count();
        return $res;
    }
    public function followers($id){
        $res = DB::table('user_user')->where('user_id2','=',$id)->count();
        return $res;
    }

    public function showFollow(){
        $user = User::find(Auth::user()->id);
        $users = $user->users()->paginate(4);
        
        return view('followers',array('users'=>$users));
    }

    public function showFollowers(){
        $ids = DB::table('user_user')->where('user_id2','=',Auth::user()->id)->get();
        $users = array();
        foreach($ids as $id){
            $aux = User::find($id);
            $users = $users->merge($aux);
        }
        return view('followers',array('users'=>$users));
    }


}
