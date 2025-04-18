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

});
