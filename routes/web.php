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


//管理员账号管理
Route::group(['prefix' => 'system', 'middleware' => ['auth']], function () {
    //系统参数配置
    Route::resource('config', 'System\ConfigController');
    Route::get('base', 'System\BaseController@index');
    Route::get('base/table_list', 'System\BaseController@ajaxTableList');
    Route::get('base/table_detail/{table_name}', 'System\BaseController@ajaxTableDetail');
    Route::get('base/table_data/{table_name}', 'System\BaseController@ajaxTableData');

});

//管理员账号管理
Route::group(['prefix' => 'building', 'middleware' => ['auth']], function () {
    //系统参数配置
    Route::resource('building', 'Building\BuildingController');
});
