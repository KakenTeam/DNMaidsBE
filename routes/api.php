<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'V1\Api'], function () {

    //Authenticate API
    Route::group(['prefix' => 'auth', ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
            Route::patch('profile', 'AuthController@updateProfile');

        });
    });

        Route::group(['namespace' => 'Admin', 'middleware' => 'auth:api'], function () {
            Route::resource('groups', 'GroupController');                   //Groups Management API
            Route::resource('users', 'UserController');                     //Users Management API
            Route::resource('rent_packages', 'RentPackageController');      //RentPackage Management API
    });
});

