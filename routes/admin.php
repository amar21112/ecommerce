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
         Route::group(['prefix' => 'categories'], function () {
             Route::get('/', 'MainCategoriesController@index')->name('admin.mainCategories');
             Route::get('create', 'MainCategoriesController@create')->name('admin.mainCategories.create');
             Route::post('store', 'MainCategoriesController@store')->name('admin.mainCategories.store');
             Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.mainCategories.edit');
             Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.mainCategories.update');
             Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.mainCategories.delete');
         });
        ############end categories routes############


//        brands route
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandsController@index')->name('admin.brands');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::post('store', 'BrandsController@store')->name('admin.brands.store');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
            Route::post('update/{id}', 'BrandsController@update')->name('admin.brands.update');
            Route::get('delete/{id}', 'BrandsController@destroy')->name('admin.brands.delete');
        });
//          end brands route
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::post('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
        });

// products route
        Route::group(['prefix' => 'products'], function () {
           Route::get('/', 'ProductsController@index')->name('admin.products');

           Route::get('general-information', 'ProductsController@create')->name('admin.products.general.create');
           Route::post('store-general-information', 'ProductsController@store')->name('admin.products.general.store');

           Route::get('change-price&offer/{id}', 'ProductsController@editPrice')->name('admin.products.general.editPrice');
           Route::POST('update-price&offer/{id}', 'ProductsController@updatePrice')->name('admin.products.general.updatePrice');

           Route::get('edit-product-in-stock/{id}', 'ProductsController@editStock')->name('admin.products.general.editStock');
           Route::POST('update-product-stock', 'ProductsController@updateStock')->name('admin.products.general.updateStock');

           Route::get('add-image/{id}', 'ProductsController@addImage')->name('admin.products.general.addImage');
           Route::post('store-image', 'ProductsController@storeImage')->name('admin.products.general.storeImage');
           Route::post('store-image-db', 'ProductsController@storeImageDb')->name('admin.products.general.storeImageDb');
        });
    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin','prefix'=>'admin'], function () {
        Route::get('/login', 'AdminAuthController@login')->name('admin.login');
        Route::post('/verifyLogin', 'AdminAuthController@verifyAdmin')->name('admin.verification');
    });
});
