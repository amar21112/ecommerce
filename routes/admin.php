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
    Route::get('/' , function (){
        return 'admin';
    });
    Route::get('/dashboard' , function (){
        return 'dashboard';
    })->name('admin.dashboard');
});

Route::group(['namespace'=>'Dashboard'], function () {
   Route::get('/login' ,'LoginController@login') ->name('admin.login');
   Route::post('/verifyLogin' ,'LoginController@verifyAdmin') ->name('admin.verification');
});
