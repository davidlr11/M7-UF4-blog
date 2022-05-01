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
/*
Route::resources([
    'posts'=>'PostController',
    'user'=>'UserController'
    'comments'=>'CommentsController'
]);*/

//PROFILE
Route::get('/profile','ProfileController@index')->name('profile');
Route::get('/profile/{id}/edit','ProfileController@edit')->name('profile.edit');
Route::put('/rofile/update/{user}','ProfileController@update')->name('profile.update');

//POSTS
Route::get('/posts','PostController@index')->name('posts.index');
Route::get('/posts/create', 'PostController@create')->name('posts.create');
Route::post('/posts', 'PostController@store')->name('posts.store');
Route::get('/posts/{post}/edit','PostController@edit')->name('posts.edit');
Route::put('/posts/update/{post}','PostController@update')->name('posts.update');
Route::delete('/posts/posts/{id}', 'PostController@destroy')->name('posts.destroy');

//ADMINISTRAR POST (ADMIN)
Route::get('/admin/posts','AdminpostController@index')->name('adminpost.index');
Route::get('/admin/posts/create', 'AdminpostController@create')->name('adminpost.create');
Route::post('/admin/posts', 'AdminpostController@store')->name('adminpost.store');
Route::get('/admin/posts/{post}/edit','AdminpostController@edit')->name('adminpost.edit');
Route::put('/admin/update/{post}','AdminpostController@update')->name('adminpost.update');
Route::delete('/admin/posts/{id}', 'AdminpostController@destroy')->name('adminpost.destroy');

//COMMENTS
Route::get('/comments/{post}','CommentController@index')->name('comment');
Route::post('/comments/store', 'CommentController@store')->name('comment.store');
Route::delete('/comments/{id}', 'CommentController@destroy')->name('comment.destroy');

//BUSCADOR
Route::get('/buscador', 'PostController@buscador')->name('buscador');
Route::get('/buscadorAdmin', 'AdminpostController@buscadorAdmin')->name('buscadorAdmin');

//TAGS
Route::delete('/tags/{id}', 'TagController@destroy')->name('tags.destroy');

//USER
Route::get('/admin/users','UserController@index')->name('users.index');
Route::get('/admin/users/create', 'UserController@create')->name('users.create');
Route::post('/admin/users', 'UserController@store')->name('users.store');
Route::get('/admin/users/{user}/edit','UserController@edit')->name('users.edit');
Route::put('/admin/update/{user}','UserController@update')->name('users.update');
Route::delete('/admin/users/{id}', 'UserController@destroy')->name('users.destroy');


//Route::put('/updatepassword','ProfileController@index')->name('updatepassword');
//Route::get('/admin','ProfileController@index')->name('admin')->middleware(['auth','role:admin']);

Auth::routes();

