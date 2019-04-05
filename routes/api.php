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
Route::get('test', function () {
   return \App\Models\Permission::find(2)->groups;
});
Route::group(['namespace' => 'V1\Api'], function () {

    //Authenticate API
    Route::group(['prefix' => 'auth', ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
        });
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['middleware' => 'isadmin'], function () {
            Route::resource('groups', 'GroupController');      //Groups Management API
            Route::resource('users', 'UserController');        //Users Management API
        });
    });
});

