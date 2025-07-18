<?php

/*
|--------------------------------------------------------------------------
| front Routes
|--------------------------------------------------------------------------
|
|
*/

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix'=>LaravelLocalization::setLocale(),
    'middleware'=>['localeSessionRedirect' , 'localizationRedirect' , 'localeViewPath']], function() {



     Route::group(['namespace'=>'Site', 'prefix'=>'E-commerce' , 'middleware'=>'auth:web'],function(){

         Route::get( '/' , 'HomeController@home' )->name('home');

         Route::get('profile',function (){
                return 'You are in ur profile';
            });

         Route::post('wishlist' , 'WishListController@store')->name('wishlist.store');
         Route::get('wishlist' , 'WishListController@index')->name('wishlist');
         Route::delete('wishlist' , 'WishListController@destroy')->name('wishlist.destroy');

         Route::get('product/{slug}' , 'ProductController@productsBySlug')->name('product.details');

     });

    Route::group(['namespace'=>'Site', 'prefix'=>'E-commerce' ],function(){
        Route::get( '/' , 'HomeController@home' )->name('home');
        Route::get('category/{slug}' , 'CategoryController@productsBySlug')->name('category');

    });
    }
);
