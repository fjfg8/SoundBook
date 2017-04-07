<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Account;
use App\Song;

class UsersController extends Controller
{
    public function show(){
        $id = session()->get('id');
        $user = User::find($id);
        $filtro = session()->get('filtro');

        if($filtro == "titulo")
        $songs = Song::select('*')->where('user_id','=',$id)->orderby('title','desc')->paginate(4);

        if($filtro=="fecha")
        $songs = Song::select('*')->where('user_id','=',$id)->orderby('date','descasc')->paginate(4);

        if($filtro=="artista")
        $songs = Song::select('*')->where('user_id','=',$id)->orderby('artist','desc')->paginate(4);
       // $songs = Song::select('*')->where('user_id','=',$id)->orderby('date','desc')->paginate(4);
        return view('profile',array('user' => $user,'songs'=>$songs));
    }

    public function search(Request $request){

        $request->session()->put([
            'filtro'=>$request->filtro
        ]);
         return redirect()->action('UsersController@show');
    }

    public function create(Request $request){
        
        $this->validate($request,[
            'nick' => 'unique:users|required',
            'password'=>'required|same:password_confirmation',
            'password_confirmation'=>'required|same:password',
            'email'=>'required',
            'name'=>'required'
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = $request->password;
        $user->nick = $request->nick;

        $user->save();

        $request->session()->put([
            'name'=>$user->name,
            'id'=>$user->id,
            'filtro'=>"fecha"
        ]);

        //$id = User::where('email',$request->email)->value('id');//recogemos la id del nuevo usuario y redirigimos al vista de user
        return redirect()->action('UsersController@show');
    }

    public function start(Request $request){
        $this->validate($request,[
            'nick'=>'required',
            'password'=>'required'
        ],
        [
            'nick.required'=>'EL nick es obligatorio'
        ]);

        if($this->comprobar($request->nick)){
           // $acc = Account::where('nick',$request->nick)->value('id');
            $user = User::where('nick','=',$request->nick)->first();
    
            if($user->password == $request->password){
                $request->session()->put([
                    'name'=>$user->name,
                    'id'=>$user->id,
                    'filtro'=>"fecha"
                ]);
                return redirect()->action('UsersController@show');
            }else{
                return redirect('/session');
            }
        }else{
            return redirect('/register');
        }

    }
    
    public function comprobar($nick){
        $acc = User::where('nick',"=",$nick)->value('id');
        if($acc == NULL){
            return false;
        }
        return true;
    }

    public function edit(Request $request){
        $user = User::findOrFail($request->id);

        if($request->has('nick')){
            $user->nick = $request->nick;
            $user->save();
        }

        if($request->has('name')){
            $user->name = $request->name;
            $user->save();
        }
        if($request->has('email')){
            $user->email = $request->email;
            $user->save();
        }
        if($request->has('gender')){
            $user->gender = $request->gender;
            $user->save();
        }
        if($request->has('status')){
            $user->status = $request->status;
            $user->save();
        }
        if($request->has('preferences')){
            $user->preferences = $request->preferences;
            $user->save();
        }

        $request->session()->put([
            'filtro'=>"fecha"
        ]);

        return redirect()->action('UsersController@show');
        //return redirect()->back();
    }



    
    
    public function change(Request $request){
        $this->validate($request,[
            'old'=>'required',
            'new'=>'required',
            'copy'=>'required'
        ]);
        $id = session()->get('id');
        $user = User::find($id);

        if($user->password != $request->old ){
            return redirect()->back()->with('msg', 'Contraseña antigua mal introducida');
        }

        if($request->new != $request->copy){
            return redirect()->back()->with('mess', 'Las contraseñas son distintas');
        }

        $user->password = $request->new;
        $user->save();

        $request->session()->put([
            'filtro'=>"fecha"
        ]);

        return redirect()->action('UsersController@show');
    }

    public function logout(){
        session()->flush();
        return redirect()->action('UsersController@start');
    }

    public function admin(){
        $users = User::select('*')->paginate(6);
        return view('admin',array('users' => $users));
    }

    public function delete(Request $request){
        $s = User::find($request->user);
        $s->delete();

        return redirect()->back();
    }


}