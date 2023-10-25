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

Route::controller(BlogController::class)->middleware('auth')->group(function(){
    //route pour afficher la page d'acceuil
    Route::get('/', 'index')->name('index');
    //roue pour afficher tous les articles
    Route::get('/all', 'all')->name('all');
    //route pour afficher les details d'un article
    Route::get('/blog/{id?}', 'show' )->name('indexWithId');
    //route pour ajouter un article
    Route::post('/blog/store', 'store')->name('blogStore');
    //route pour afficher le formulaire d'ajout d'un article
    Route::get('/create-blog', 'createBlog')->name('createBlog');
    Route::get('print/blog', 'printblog')->name('printBlog');
});

/* Route::get('/', [BlogController::class, "index"])->name('index')->middleware('auth'); */

Route::controller(UserController::class)->prefix('user')->group(function(){
    //route pour afficher le formulaire d'authentification
    Route::get('/login', 'login')->name('login');
    //route pour se déconnecter
    Route::get('/logout', 'logout')->name('logout');
    //route pour afficher le formulaire d'inscription
    Route::get('/register', 'register')->name('register');
    //route pour passer les données de celui qui s'inscris
    Route::post('/store/register', 'store')->name('storeUser');
    //route pour confirmer un mail
    Route::get('/verify_email/{email}', 'verify')->name('verifyEmail');
    //route pour pour se connecter(authentification)
    Route::post('/authentification', 'authentification')->name('authentification');
    //route pour afficher la page de recuperation de mot de passe a l'aide d'un mail
    Route::get('/recovery', 'recovery')->name('recovery');
    //route pour afficher la page pour changer le mot de passe
    Route::post('/change_password', 'change')->name('change');
    //route pour verifier envoyer le mail de recuperation
    Route::get('/check_password/{email}', 'check')->name('check');
    //route pour faire la mise à jour du mot de passe
    Route::post('/store_password/{email}', 'updatepassword')->name('storePassword');
});
