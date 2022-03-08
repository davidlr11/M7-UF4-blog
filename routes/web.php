<?php

use App\Http\Controllers\IndexController;

use Illuminate\Support\Facades\Route;
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

/*Route::get('/', function () {
    return view('welcome');
});*/


//Rutes principals


//Route::get('/',[IndexController::class,'index'])->name('index');
//Route::get('/',[HomeController::class,'index'])->name('home');

/*Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
    Route::get('/',function(){
        return "admin.......users.";

    })->name('admin.users');

    //administración, backend users, backend posts
    //Route::get()----

});*/


//Route::view('/','home',['posts'=>['title'=>'Hola','contents'=>'Lorem']]);
/*Route::get('posts/{post?}',function(Post $post){
    if($post==null){
        return Post::all();
    }
    $post=Post::findOrFail($post);
    return $post;

})->where('post','[0-9]+');*/
/*->middleware(['auth'])*/;

/*Route::get('posts/{post?}',function(Post $post){
    return $post;

});*/
/*->middleware(['auth'])*/;

/*Route::resources([
    'posts'=>'PostController',
    'users'=>'UserController',
    'comments'=>'CommentController'
]);*/
//Route::get('/home','HomeController@index')->name('home');
/*Route::get('/','HomeController@index')->name('home');
Auth::routes();*/

//rutas nuevas

Route::get('/','HomeController@index')->name('home'); 

Route::resources([
    'posts'=>'PostController',
    'user'=>'UserController',
    'comments'=>'CommentsController'
]);

Route::get('/profile','ProfileController@index')->name('profile');
Route::get('/profile/edit','ProfileController@edit')->name('profile.edit');
Route::put('/profile/update','ProfileController@update')->name('profile.update');

//Route::put('/updatepassword','ProfileController@index')->name('updatepassword');

Route::get('/admin','ProfileController@index')->name('admin')->middleware(['auth','role:admin']);

Auth::routes();






