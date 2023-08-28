<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    $nom = 'Arso';
    //return view('blog', ['name'=>$nom]);
    return view('blog', compact('nom'));
})->name('index'); */



/* Route::get('/',"App\Http\Controllers\BlogController@index")->name("name") */

/* Route::get('/blog/{id}', function ($id) {
    $nom = 'Arso';
    //return view('blog', ['name'=>$nom]);
    return view('blog', compact('nom', 'id'));
})->name('indexWithId'); */

Route::controller(BlogController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/blog/{id?}', 'show' )->name('indexWithId');
    Route::post('/blog/store', 'store')->name('blogStore');
    Route::get('/create-blog', 'createBlog')->name('createBlog');
});

/* Route::get('/', [BlogController::class, "index"])->name('index')->middleware('auth');

Route::get('/blog/{id?}', [BlogController::class,'show'])->name('indexWithId');

Route::post('/blog/store', [BlogController::class,'store'])->name('blogStore');

Route::get('/create-blog', [BlogController::class, 'createBlog'])->name('createBlog'); */

Route::get('login', [UserController::class, 'login'])->name('login');

Route::get('register', [UserController::class, 'register'])->name('register');