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
            

        $follow = $this->follow($id);
        $followers = $this->followers($id);
        return view('home',array('user' => $user,'songs'=>$songs,'follow'=>$follow,'followers'=>$followers));
    }


    public function follow($id){
        $res = DB::table('user_user')->where('user_id1','=',$id)->count();
        return $res;
    }
    public function followers($id){
        $res = DB::table('user_user')->where('user_id2','=',$id)->count();
        return $res;
    }
}
