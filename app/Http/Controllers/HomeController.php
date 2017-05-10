<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Song;
use Illuminate\Support\Facades\DB;
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
        if(session()->has("filtro")){
           $filtro = session()->get('filtro'); 
        }else{
            $filtro = "fecha";
        }

        if($filtro == "titulo")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('title','asc')->paginate(4);

        if($filtro=="fecha")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('date','asc')->paginate(4);

        if($filtro=="artista")
            $songs = Song::select('*')->where('user_id','=',$id)->orderby('artist','asc')->paginate(4);
            

        $follow = $this->follow();
        $followers = $this->followers();
        return view('home',array('user' => $user,'songs'=>$songs,'follow'=>$follow,'followers'=>$followers));
    }


    public function follow(){
        $res = DB::table('user_user')->where('user_id1','=',Auth::user()->id)->count();
        return $res;
    }
    public function followers(){
        $res = DB::table('user_user')->where('user_id2','=',Auth::user()->id)->count();
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
