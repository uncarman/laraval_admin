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

Auth::routes();

Route::get('/', function () {
    return redirect()->intended('dashboard');
});
Route::get('/home', function () {
    return redirect()->intended('dashboard');
});

Route::get('/sam/fun1', ['uses'=>'SamController@fun1']);
Route::get('/sam/fun2', ['uses'=>'SamController@fun2']);


//管理员账号管理
Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/ajax_get_building_total', 'HomeController@ajaxGetBuildingSummary')->name('ajaxGetBuildingSummary');
    Route::get('/ajax_get_building_total_by_date', 'HomeController@ajaxGetSummaryByDate')->name('ajaxGetSummaryByDate');
    Route::get('/ajax_get_meters', 'HomeController@ajaxGetMeters')->name('ajaxGetMeters');
    Route::get('/ajax_get_meter_datas', 'HomeController@ajaxGetMeterDatas')->name('ajaxGetMeterDatas');


    // 分组管理
    Route::get('/groups', 'HomeController@dashboard')->name('dashboard');
});



Route::group(['prefix' => 'monitor', 'middleware' => ['auth']], function () {
    Route::get('summary', 'Monitor\MonitorSummaryController@index');
    Route::get('ammeter', 'Monitor\MonitorAmmeterController@index');
    Route::get('watermeter', 'Monitor\MonitorWatermeterController@index');

});
Route::group(['prefix' => 'statistics', 'middleware' => ['auth']], function () {
    Route::get('summary', 'Statistics\StatisticsSummaryController@index');
    Route::get('ammeter', 'Statistics\StatisticsAmmeterController@index');
    Route::get('watermeter', 'Statistics\StatisticsWatermeterController@index');

});



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

    // 分组管理
    Route::get('{building_id}/groups', 'Building\GroupController@index')->name('building_groups');
    Route::get('ajaxGroupTree', 'Building\GroupController@ajaxGroupTree')->name('ajaxGroupTree');

});


