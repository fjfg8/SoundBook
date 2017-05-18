<?php
use App\Song;
use App\User;
use App\Type;
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
    Route::get('/visit/{id}','HomeController@visitProfile');
    Route::delete('/vistit','UsersController@unfollow');
    Route::put('/visit','UsersController@follow');

    Route::post('user/','UsersController@search');
    Route::put('user/','UsersController@edit');
    Route::get('/pass',function(){
        return view('pass');
    });

    Route::post('/change','UsersController@changePass');
    //Route::post('/song/{id}','SongsController@show');
    Route::post('/song','SongsController@like');

    Route::put('/song','CommentController@like');
    Route::delete('/song','CommentController@delete');
    Route::delete('/user','SongsController@delete');

    Route::put('editSong','SongsController@edit');

    Route::get('/song/{id}/edit/{c}',function($id,$c){
        return view('comment',array('song'=>$id,'comment'=>$c));
    });
    Route::put('/edit','CommentController@edit');
    Route::post('comment/','CommentController@create');

    Route::get('/groups/{id}','GroupsController@show');

    Route::put('/uploadSong','SongsController@create');

    Route::get('/listagrupos','GroupsController@showlista');
    
    Route::get('/home', 'HomeController@index');

    Route::get('/searcher','SearchController@show');

    Route::post('/searcher','SearchController@search');

    Route::put('/searcher','UsersController@follow');

    Route::delete('/searcher','UsersController@unfollow');

    Route::get('/wall','WallController@show');
    Route::post('/wall','SongsController@like');

    Route::get('/home/follow','HomeController@showFollow');

    Route::get('/home/followers','HomeController@showFollowers');

});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin','UsersController@admin');
    Route::delete('/admin','UsersController@delete');
});


Auth::routes();
