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
        $user = User::findOrFail($request->id);

        $this->validate($request,[
            'nick'=>'unique:users|max:20',
            'name' => 'max:30',
            'email'=>'unique:users|max:50',
            'preferences' => 'max:100',
        ]);

        if($request->has('nick')){
            $user->nick = $request->nick;
        }

        if($request->has('name')){
            $user->name = $request->name;            
        }

        if($request->has('email')){
            $user->email = $request->email;
        }

        if($request->has('gender')){
            $user->gender = $request->gender;
        }

        if($request->has('status')){
            $user->status = $request->status;
        }

        if($request->has('preferences')){
            $user->preferences = $request->preferences;
        }

        $user->save();
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
        $id = Auth::user()->id;
        $user = User::find($id);

        if(!Hash::check($request->old, $user->password)){
            return redirect()->back()->with('msg', 'La contraseña guardada no coincide con la introducida');
        }

        if($request->new != $request->copy){
            return redirect()->back()->with('mess', 'La nueva contraseña no coincide con la confirmación');
        }

        $user->password = bcrypt($request->new);
        $user->save();

        $request->session()->put([
            'filtro'=>"Fecha"
        ]);

        return redirect()->action('HomeController@index');
    }

   /* public function logout(){
        session()->flush();
        return redirect()->action('UsersController@start');
    }*/

    public function admin(){
        $users = User::select('*')->paginate(4);
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
        $user = User::findOrFail($request->id);
        $user->isAdmin = true;
        $user->save();

        return redirect()->back();
    }

    public function delete(Request $request){
        $s = User::find($request->user);
        $s->delete();

        return redirect()->back();
    }

    public function follow(Request $request){
        $user1 = Auth::user();
        $user2 = User::find($request->user);

        $user1->users()->attach($user2->id);

        //return redirect()->action('HomeController@index');
        return redirect()->back();
    }

    public function unfollow(Request $request){
        $user1 = Auth::user();
        $user2 = User::find($request->user);

        $result = DB::table('user_user')->where('user_id1','=',$user1->id)->where('user_id2','=',$user2->id);

        $result->delete();

        //return redirect()->action('HomeController@index');
        return redirect()->back();
    }

    public function changeImage(Request $request){
        $user = User::find(Auth::user()->id);

        $this->validate($request,[
            'Imagen' => 'required'
        ]);

        $user->image = $request->Imagen;
        $user->save();

        return redirect()->action('HomeController@index');
    }


}