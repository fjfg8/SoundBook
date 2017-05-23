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
        $id = Auth::user()->id;
        $user = User::find($id);
        $types = Type::all();

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

        $songs = Song::select('*')->where('user_id','=',$id)->orderby('date','asc')->paginate(4);

        if($filtro == "Titulo")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('title','asc')->paginate(4);
            

        if($filtro == "Artista")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('artist','asc')->paginate(4);
            
        session()->put([
            'filtro'=> $filtro,
        ]);

        $follow = $this->follow(Auth::user()->id);
        $followers = $this->followers(Auth::user()->id);
        
        return view('home',array('user' => $user,'songs'=>$songs,'follow'=>$follow,'followers'=>$followers, 
            'types'=>$types, 'generos'=>$generos, 'filters'=>$filters, 'estados'=>$estados));
    }

    public function visitProfile($id){
        if(Auth::user()->id != $id){
            $user = User::find($id);
            $songs = $user->songs()->paginate(4);
            $follow = $this->follow($user->id);
            $followers = $this->followers($user->id);
            $bool = $this->followProfile($user->id);

            return view('user',array('user' => $user,'songs'=>$songs,'follow'=>$follow,'followers'=>$followers,'bool'=>$bool));
        }
        else{
            return redirect()->action('HomeController@index');
        }
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
        $users = Auth::user()->users;
        
        return view('following',array('users'=>$users));
    }

    public function showFollowers(){
        $ids = DB::table('user_user')->where('user_id2',Auth::user()->id)->get();
        $users = array();
        if(sizeof($ids)==0){
            return view('followers',array('users'=>$users));
        }else{
            for($i=0;$i<sizeof($ids);$i++){
                $aux = User::find($ids[$i]->user_id1);
                //$users = $users->merge($aux);
                $users[$i]=$aux;
            }
        }
        return view('followers',array('users'=>$users));
    }


}
