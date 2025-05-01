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
        Route::get('logout', 'AdminAuthController@logout')->name('admin.logout');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingMethods')->name('edit.shipping.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingMethods')->name('update.shipping.methods');
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
            Route::put('update', 'ProfileController@updateProfile')->name('update.profile');
//            Route::put('update/password', 'ProfileController@updateProfilePassword')->name('update.profile.password');
        });

        ############categories routes################
         Route::group(['prefix' => 'main-categories'], function () {
             Route::get('/', 'MainCategoriesController@index')->name('admin.mainCategories');
             Route::get('create', 'MainCategoriesController@create')->name('admin.mainCategories.create');
             Route::post('store', 'MainCategoriesController@store')->name('admin.mainCategories.store');
             Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.mainCategories.edit');
             Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.mainCategories.update');
             Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.mainCategories.delete');
         });
        ############end categories routes############
    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin','prefix'=>'admin'], function () {
        Route::get('/login', 'AdminAuthController@login')->name('admin.login');
        Route::post('/verifyLogin', 'AdminAuthController@verifyAdmin')->name('admin.verification');
    });
});
