<?php

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Dashboard', 'middleware'=>'auth:admin'], function () {

    Route::get('/' ,'DashboardController@index')->name('admin.dashboard');

});

Route::group(['namespace'=>'Dashboard' , 'middleware'=>'guest:admin'], function () {
   Route::get('/login' ,'LoginController@login') ->name('admin.login');
   Route::post('/verifyLogin' ,'LoginController@verifyAdmin') ->name('admin.verification');
});
