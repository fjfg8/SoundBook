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

    Route::post('/user','UsersController@search');
    Route::post('/change','UsersController@changePass');
    Route::post('/changeImage','UsersController@changeImage');
    Route::put('/user','UsersController@edit');
    Route::put('/visit','UsersController@follow');
    Route::put('/searcher','UsersController@follow');
    Route::delete('/vistit','UsersController@unfollow');
    Route::delete('/searcher','UsersController@unfollow');
    


    Route::get('/song/{id}','SongsController@show');
    Route::post('/song','SongsController@like');
    Route::post('/wall','SongsController@like');
    Route::put('/uploadSong','SongsController@create');    
    Route::put('editSong','SongsController@edit');
    Route::delete('/user','SongsController@delete');
    


    Route::post('comment/','CommentController@create');
    Route::put('/song','CommentController@like');
    Route::put('/edit','CommentController@edit');
    Route::delete('/song','CommentController@delete');
    
    

    Route::get('/groups/{id}','GroupsController@show');
    Route::get('/listagrupos','GroupsController@showlista');


    
    Route::get('/home', 'HomeController@index');
    Route::get('/visit/{id}','HomeController@visitProfile');
    Route::get('/home/follow','HomeController@showFollow');
    Route::get('/home/followers','HomeController@showFollowers');



    Route::get('/searcher','SearchController@show');
    Route::post('/searcher','SearchController@search');

    

    Route::get('/wall','WallController@show');
    

    

    Route::get('/changeImage',function(){
        return view('image');
    });

    Route::get('/pass',function(){
        return view('pass');
    });
    

});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin','UsersController@admin');
    Route::delete('/admin','UsersController@delete');
});


Auth::routes();
