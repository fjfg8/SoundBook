<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Song;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Session;

class UsersController extends Controller
{

    public function search(Request $request){
        $request->session()->put([
            'filtro'=>$request->filtro
        ]);

        return redirect()->action('HomeController@index');
    }

    public function edit(Request $request){
        

        $this->validate($request,[
            'nick'=>'unique:users|max:20',
            'name' => 'max:30',
            'email'=>'unique:users|max:50',
            'preferences' => 'max:100',
        ]);

        User::edit($request);
        $request->session()->put([
            'filtro'=>"Fecha"
        ]);        
        
        return redirect()->back();
    }

    public function changePass(Request $request){
        $this->validate($request,[
            'old'=>'required|min:6',
            'new'=>'required|min:6',
            'copy'=>'required|min:6'
        ]);
        $user = User::search(Auth::user()->id);
        

        if(!Hash::check($request->old, $user->password)){
            return redirect()->back()->with('msg', 'La contraseña guardada no coincide con la introducida');
        }

        if($request->new != $request->copy){
            return redirect()->back()->with('mess', 'La nueva contraseña no coincide con la confirmación');
        }

        User::changePass($user,$request->new);

        $request->session()->put([
            'filtro'=>"Fecha"
        ]);

        return redirect()->action('HomeController@index');
    }

    public function admin(){
        $users = User::getAll();
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

        return view('admin',array('users' => $users,'generos'=>$generos,'estados'=>$estados));
    }

    public function makeAdmin(Request $request){
        
        User::makeAdmin($request->id);
        return redirect()->back();
    }

    public function removeAdmin(Request $request){
        User::removeAdmin($request->id);
        return redirect()->back();
    }

    public function delete(Request $request){
        User::borrar($request->user);
        return redirect()->back();
    }

    public function follow(Request $request){
        
        User::makeFollow($request->user);
        return redirect()->back();
    }

    public function unfollow(Request $request){
        
        User::makeUnfollow($request->user);
        //return redirect()->action('HomeController@index');
        return redirect()->back();
    }

    public function changeImage(Request $request){
        $user = User::search(Auth::user()->id);

        $this->validate($request,[
            'Imagen' => 'required'
        ]);

        User::changeImage($request->Imagen);

        return redirect()->action('HomeController@index');
    }


}