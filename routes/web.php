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

Route::get('/', 'HomeController@index')->name('home');


Route::prefix('sandbox')->group(function () {
	Route::post('/withdraw', 'SandboxController@withdraw');
	Route::post('/getPlayerInfo', 'SandboxController@getPlayerInfo');
	Route::post('/withdrawDeposit', 'SandboxController@withdrawDeposit');
	Route::delete('/rollbackTransaction', 'SandboxController@rollbackTransaction');
});