<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Song;
use Illuminate\Support\Facades\DB;

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
            $user->nick = $request->nick;
            //$user->save();
        }

        if($request->has('name')){
            $user->name = $request->name;
            //$user->save();
        }
        if($request->has('email')){
            $user->email = $request->email;
            //$user->save();
        }
        if($request->has('gender')){
            $user->gender = $request->gender;
            //$user->save();
        }
        if($request->has('status')){
            $user->status = $request->status;
            //$user->save();
        }
        if($request->has('preferences')){
            $user->preferences = $request->preferences;
            //$user->save();
        }
        $user->save();
        $request->session()->put([
            'filtro'=>"fecha"
        ]);

        return redirect()->action('HomeController@index');
        //return redirect()->back();
    }

    public function change(Request $request){
        $this->validate($request,[
            'old'=>'required',
            'new'=>'required',
            'copy'=>'required'
        ]);
        $id = Auth::user()->id;
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

        return redirect()->action('HomeController@index');
    }

   /* public function logout(){
        session()->flush();
        return redirect()->action('UsersController@start');
    }*/

    public function admin(){
        $users = User::select('*')->paginate(6);
        return view('admin',array('users' => $users));
    }

    public function delete(Request $request){
        $s = User::find($request->user);
        $s->delete();

        return redirect()->back();
    }

    public function follow(Request $request){
        $user1 = Auth::user();
        $user2 = User::find($request->user);

        //$user1->user()->attach($user2->id);
        DB::table('user_user')->insert([
            'user_id1' => $user1->id,
            'user_id2' => $user2->id
        ]);

        $user1->follow = $user1->follow+1;
        $user1->save();

        $user2->followers = $user2->followers+1;
        $user2->save();

        return redirect()->action('HomeController@index');

    }

    public function unfollow(Request $request){
        $user1 = Auth::user();
        $user2 = User::find($request->user);

        $result = DB::table('user_user')->where('user_id1','=','$user1->id')->where('user_id2','=','$user2->id');

        $result->delete();

        $user1->follow = $user1->follow-1;
        $user1->save();

        $user2->followers = $user2->followers-1;
        $user2->save();

        return redirect()->action('HomeController@index');

    }


}