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
    return view('principal.index');
});
Route::get('/logout', function () {
    Session::flush();
    return redirect('/');
});

Route::get('/index',function(){
    return view('principal.index');
});
Route::get('/features',function(){
    return view('principal.features');
});
Route::get('/testimonials',function(){
    return view('principal.testimonials');
});
Route::get('/contact',function(){
    return view('principal.contact');
});

Route::group(['middleware' => 'auth'], function() {


    Route::post('/user','UsersController@search');
    Route::post('/change','UsersController@changePass');
    Route::post('/changeImage','UsersController@changeImage');
    Route::put('/editUser','UsersController@edit');
    Route::put('/follow','UsersController@follow');
    Route::delete('/unfollow','UsersController@unfollow');
    


    Route::get('/song/{id}','SongsController@show');
    Route::post('/song','SongsController@like');
    Route::post('/wall','SongsController@like');
    Route::put('/uploadSong','SongsController@create');    
    Route::put('/editSong','SongsController@edit');
    Route::delete('/deleteSong','SongsController@delete');
    Route::put('/uploadSong','SongsController@create');
    


    Route::post('/comment','CommentController@create');
    Route::put('/likeComment','CommentController@like');
    Route::put('/editComment','CommentController@edit');
    Route::delete('/deleteComment','CommentController@delete');
    
    

    Route::get('/groups/{id}','GroupsController@show');
    Route::get('/listagrupos','GroupsController@showlista');
    Route::get('/allGroups','GroupsController@showAll');
    Route::post('/allGroups','GroupsController@search');
    Route::put('/createGroup','GroupsController@create');
    Route::get('/members/{id}','GroupsController@members');
    Route::put('/subscribe','GroupsController@subscribe');
    Route::delete('/cancelSubscribe','GroupsController@CancelSubscribe');
    Route::delete('/deletegroup','GroupsController@deleteGroup');
    //Publicaciones grupos
    Route::delete('/groups/','PublicationController@delete');
    Route::put('/groups/', 'PublicationController@edit');
    Route::post('/groups/', 'PublicationController@create');

    
    Route::get('/home', 'HomeController@index');
    Route::get('/visit/{id}','HomeController@visitProfile');
    Route::get('/home/follow','HomeController@showFollow');
    Route::get('/home/followers','HomeController@showFollowers');



    Route::get('/searcher','SearchController@show');
    Route::post('/search','SearchController@search');

    

    Route::get('/wall','WallController@show');
    
    

    Route::get('/changeImage',function(){
        return view('change_image');
    });

    Route::get('/changePass',function(){
        return view('change_pass');
    });
    

});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin','UsersController@admin');
    Route::put('/makeAdmin','UsersController@makeAdmin');
    Route::delete('/deleteUser','UsersController@delete');
});


Auth::routes();
