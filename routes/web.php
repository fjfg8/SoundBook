<?php
Use App\Song;
use App\User;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/song/{id}','SongsController@show');
    Route::post('user/','UsersController@search');
    Route::put('user/','UsersController@edit');
    Route::get('/pass',function(){
        return view('pass');
    });
    Route::post('pass','UsersController@change');
    Route::post('/song/{id}','SongsController@show');
    Route::put('/song','CommentController@like');
    Route::delete('/song','CommentController@delete');
    Route::delete('/user','SongsController@delete');
    Route::get('/song/{id}/change',function($id){
        return view('edit_song',array('song'=>$id));
    });
    Route::put('change','SongsController@edit');
    Route::get('/song/{id}/edit/{c}',function($id,$c){
        return view('comment',array('song'=>$id,'comment'=>$c));
    });
    Route::put('/edit','CommentController@edit');
    Route::post('comment/','CommentController@create');
    Route::get('/upload',function(){
        return view('upload');
    });
    Route::post('/upload','SongsController@create');
    Route::get('/groups','GroupsController@show');
    Route::get('/listagrupos','GroupsController@showlista');
    
    Route::get('/home', 'HomeController@index');

    Route::get('/searcher','SearchController@show');

    Route::post('/searcher','SearchController@search');

    Route::put('/searcher','UsersController@follow');

    Route::delete('/searcher','UsersController@unfollow');

    Route::get('/wall','WallController@show');

    Route::get('/home/follow','HomeController@showFollow');

    Route::get('/home/followers','HomeController@showFollowers');
});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin','UsersController@admin');
    Route::delete('/admin','UsersController@delete');
      Route::get('/user/{id}/edit',function($id){
            $user=User::find($id);
            return view('edit_user',array('user'=>$user));
        });
});


Auth::routes();
