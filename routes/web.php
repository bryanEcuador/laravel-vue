<?php

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
require __DIR__.'\modulos\administrador.php';
require __DIR__.'\modulos\vendedor.php';

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
route::get('log',function() {
   return auth()->user()->name;
});
Route::get('/home', 'HomeController@index')->name('home');
