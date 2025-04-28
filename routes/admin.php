<?php

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
|
*/

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix'=>LaravelLocalization::setLocale(),
    'middleware'=>['localeSessionRedirect' , 'localizationRedirect' , 'localeViewPath']], function() {


    Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin' ,'prefix'=>'admin'], function () {

        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingMethods')->name('edit.shipping.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingMethods')->name('update.shipping.methods');
        });
    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin','prefix'=>'admin'], function () {
        Route::get('/login', 'LoginController@login')->name('admin.login');
        Route::post('/verifyLogin', 'LoginController@verifyAdmin')->name('admin.verification');
    });
});
