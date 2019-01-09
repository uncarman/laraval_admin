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

Route::get('/', function () {
    return redirect()->intended('dashboard');
});
Route::get('/welcome', function () {
    return redirect()->intended('dashboard');
});


Route::get('/sam/fun1', ['uses'=>'SamController@fun1']);
Route::get('/sam/fun2', ['uses'=>'SamController@fun2']);

Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
