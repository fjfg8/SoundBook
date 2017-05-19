<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Song;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
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

        if($request->has('nick')){
            $existe = User::where('nick','=',$request->nick)->count();
            if($existe == 0){
                $user->nick = $request->nick;
            }else{
                Session::flash('error_nick', 'Ese nick ya existe');
                return redirect()->back();
            }
        }

        if($request->has('name')){
            $user->name = $request->name;            
        }

        if($request->has('email')){
            $existe = User::where('email','=',$request->email)->count();
            if($existe == 0){
                $user->email = $request->email;
            }else{
                Session::flash('error_email', 'Ese email ya existe');
                return redirect()->back();
            }
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
            'old'=>'required',
            'new'=>'required',
            'copy'=>'required'
        ]);
        $id = Auth::user()->id;
        $user = User::find($id);

        if($user->password != bcrypt($request->old)){
            return redirect()->back()->with('msg', 'Contraseña antigua mal introducida');
        }

        if($request->new != bcrypt($request->copy)){
            return redirect()->back()->with('mess', 'Las contraseñas son distintas');
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

        $user->image = $request->new;
        $user->save();

        return redirect()->action('HomeController@index');
    }


}