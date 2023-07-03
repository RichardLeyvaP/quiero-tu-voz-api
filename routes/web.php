<?php

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

Route::get('/', function () {
    return view('welcome');
});


//PROBANDO RUTAS RICHARD
Route::get('/greeting', function () {
    return 'Hello World';
});
Route::get('/user/{id}', function (string $id) {
    return 'User '.$id+25;
});

Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {
   return 'Post:'.$postId.' Coment:'.$commentId;
});

Route::get('/user/profile', function () {
    // ...
})->name('profile');

Route::fallback(function () {//se ejecuta cuando ninguna otra ruta coincida con la solicitud entrante
    return view('welcome');
});
