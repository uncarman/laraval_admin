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

    Route::get('/ajaxMeterSummary', 'Monitor\MonitorSummaryController@ajaxMeterSummary');

    Route::get('/ajaxAmmeterSummary', 'Monitor\MonitorAmmeterController@ajaxAmmeterSummary');
    Route::get('/ajaxAmmeterGroupsSummaryDaily/{groupTypeId}', 'Monitor\MonitorAmmeterController@ajaxAmmeterGroupsSummaryDaily');

});
Route::group(['prefix' => '/{buildingId}/statistics', 'middleware' => ['auth']], function () {
    Route::get('/summary', 'Statistics\StatisticsSummaryController@index');
    Route::get('/summaryFee', 'Statistics\StatisticsSummaryController@summaryFee');

    Route::get('/ammeter', 'Statistics\StatisticsAmmeterController@index');
    Route::get('/watermeter', 'Statistics\StatisticsWatermeterController@index');

    Route::get('/ajaxMeterSummary', 'Statistics\StatisticsSummaryController@ajaxMeterSummary');
    Route::get('/ajaxMeterSummaryFee', 'Statistics\StatisticsSummaryController@ajaxMeterSummaryFee');
});
Route::group(['prefix' => '/{buildingId}/warning', 'middleware' => ['auth']], function () {
    Route::get('/summary', 'Warning\WarningSummaryController@index');
    Route::get('/alertSettings', 'Warning\WarningSummaryController@alertSettings');

    Route::get('/ajaxWarning', 'Warning\WarningSummaryController@ajaxWarning');
    Route::get('/ajaxAlertList', 'Warning\WarningSummaryController@ajaxAlertList');
});

Route::group(['prefix' => '/{buildingId}/settings', 'middleware' => ['auth']], function () {
    Route::get('/summary', 'Settings\SettingsSummaryController@index');

    Route::get('/group', 'Settings\SettingsSummaryController@groupView');
    Route::get('/group/{groupTypeId}/edit', 'Settings\SettingsSummaryController@groupEdit');
    Route::get('/ajaxGroupTree', 'Settings\SettingsSummaryController@ajaxGroupTree');

    Route::get('/device', 'Settings\SettingsDeviceController@index');
    Route::get('/ajaxDeviceList', 'Settings\SettingsDeviceController@ajaxDeviceList');

//    Route::get('/ajaxAlertList', 'Settings\SettingsSummaryController@ajaxAlertList');
});

//////////////////  多个建筑 //////////////////
