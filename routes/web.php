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

//////////////////  单个建筑 //////////////////
Route::group(['prefix' => '/{buildingId}/monitor', 'middleware' => ['auth']], function () {
    Route::get('/summary', 'Monitor\MonitorSummaryController@index');
    Route::get('/ammeter', 'Monitor\MonitorAmmeterController@index');
    Route::get('/ammeterByType', 'Monitor\MonitorAmmeterController@ammeterByType');
    Route::get('/watermeter', 'Monitor\MonitorWatermeterController@index');

    Route::get('/ajaxAmmeterGroupsSummaryDaily/{groupTypeId}', 'Monitor\MonitorAmmeterController@ajaxAmmeterGroupsSummaryDaily');

});
Route::group(['prefix' => '/{buildingId}/statistics', 'middleware' => ['auth']], function () {
    Route::get('/summary', 'Statistics\StatisticsSummaryController@index');
    Route::get('/ammeter', 'Statistics\StatisticsAmmeterController@index');
    Route::get('/watermeter', 'Statistics\StatisticsWatermeterController@index');
});


//////////////////  多个建筑 //////////////////
