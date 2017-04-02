<?php
Use App\Song;
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
    return redirect('/session');
});

Route::get('/register',function(){
    return view('register');
});
Route::get('/song/{id}','SongsController@show');

Route::get('/user/{id}','UsersController@show');

Route::post('user/','UsersController@edit');

Route::post('/register','UsersController@create');

Route::get('/session',function(){
    return view('session');
});

Route::post('/session','UsersController@start');

Route::get('/pass',function(){
    return view('pass');
});

Route::post('pass','UsersController@change');

Route::post('/song/{id}','SongsController@show');


Route::post('/song','CommentController@like');


Route::get('/song/{id}/comment',function($id){
    return view('comment',array('song'=>$id));
});

Route::post('comment/','CommentController@create');

Route::get('user/{id}/upload',function($id){
    return view('upload',array('user'=>$id));
});
Route::post('upload/','SongsController@create');