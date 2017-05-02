<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Song;
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
        //$filtro = session()->get('filtro');
        $filtro = "titulo";
        $songs = null;

        if($filtro == "titulo")
        $songs = Song::select('*')->where('user_id','=',$id)->orderby('title','desc')->paginate(4);

        if($filtro=="fecha")
        $songs = Song::select('*')->where('user_id','=',$id)->orderby('date','descasc')->paginate(4);

        if($filtro=="artista")
        $songs = Song::select('*')->where('user_id','=',$id)->orderby('artist','desc')->paginate(4);
        return view('home',array('user' => $user,'songs'=>$songs));
    }
}
