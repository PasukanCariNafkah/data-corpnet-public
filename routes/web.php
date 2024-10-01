<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('corpnet', 'CorpnetController');
Route::get('corpnet/to-logbook/{corpnet}', "CorpnetController@create_to_logbook")->name('corpnet.logbook');
Route::resource('olt', 'OltController')->except('show');
Route::resource('logbook-user-daily', 'LogbookUser\LogbookDailyController')->except('store');
Route::post("logbook-user-daily/corpnet/{corpnet}", "LogbookUser\LogbookDailyController@store_from_corpnet")->name("logbook-user-daily.storefromdata");
Route::post("logbook-user-daily", "LogbookUser\LogbookDailyController@store_from_logbook")->name("logbook-user-daily.storefromlogbook");
Route::post('lobook-user-daily/subcat', "LogbookUser\LogbookDailyController@subcat")->name("logbook-user-daily.subcat");
Route::post('lobook-user-daily/add-logbook', "LogbookUser\LogbookDailyController@add_logbook")->name("logbook-user-daily.add-logbook");
Route::resource('logbook-user-weekly', 'LogbookUser\LogbookWeeklyController');

Route::prefix('report')->group(function() {
    Route::get("logbook-user-daily", "ReportController@report_logbook_user_daily")->name('report.logbookUserDaily');
    Route::get("logbook-user-weekly", "ReportController@report_logbook_user_weekly")->name('report.logbookUserWeekly');
    Route::get("logbook-network-daily", "ReportController@report_logbook_network_daily")->name('report.logbookNetworkDaily');
    Route::get("logbook-network-weekly", "ReportController@report_logbook_network_weekly")->name('report.logbookNetworkWeekly');
    Route::get("logbook-upstream-daily", "ReportController@report_logbook_upstream_daily")->name('report.logbookUpstreamDaily');
    Route::get("logbook-upstream-weekly", "ReportController@report_logbook_upstream_weekly")->name('report.logbookUpstreamWeekly');
    
});

Route::resource('ups', "UpsController");



Route::resource('logbook-network-daily', 'LogbookNetwork\LogbookDailyController');
Route::resource('logbook-network-weekly', 'LogbookNetwork\LogbookWeeklyController');
Route::post('lobook-network-daily/subcat', "LogbookNetwork\LogbookDailyController@subcat")->name("logbook-network-daily.subcat");


Route::resource('user-upstream', "Upstream\UserUpstreamController");
Route::resource('logbook-upstream-daily', 'LogbookUpstream\LogbookDailyController');
Route::resource('logbook-upstream-weekly', 'LogbookUpstream\LogbookWeeklyController');
Route::post('lobook-upstream-daily/subcat', "LogbookUpstream\LogbookDailyController@subcat")->name("logbook-upstream-daily.subcat");
// Route::get('ups', "UpsController@index")