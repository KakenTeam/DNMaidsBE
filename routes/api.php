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
   
    Route::get('find_helpers/{contract}', 'Admin\ContractController@findHelper' );
    Route::post('feecalculator', 'Admin\FeeController@fee');
    //Authenticate API
    Route::group(['prefix' => 'auth',], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
            Route::patch('profile', 'AuthController@updateProfile');
            Route::put('password', 'AuthController@updatePassword');


        });
    });
    //Client
    Route::group(['prefix' => 'client','namespace' => 'Client', 'middleware' => 'auth:api'], function () {

        Route::resource('contracts', 'ContractController')->only('store','index');
        Route::resource('feedbacks', 'FeedbackController')->only('store');
    });

    ///Admin
    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:api'], function () {
        Route::resource('groups', 'GroupController')->except('create', 'edit');                   //Groups Management API
        Route::resource('permissions', 'PermissionController')->only('index');         //Permissions Management API
        Route::resource('users', 'UserController')->except('create', 'edit');                     //Users Management API

        //Contracts Management API
        Route::resource('contracts', 'ContractController')->except('create', 'edit');
        Route::group(['prefix' =>'contracts'], function () {
            Route::patch('{contract}/status', 'ContractController@updateStatus' );
            Route::patch('{contract}/assign', 'ContractController@updateHelper' );

        });
        Route::resource('feedbacks', 'FeedbackController')->except('create', 'edit');             //Feedbacks Management API
        Route::resource('emp_contracts', 'EmpContractController')->except('update', 'create', 'edit');      //Employees' labour Contract Management API

        Route::resource('skills', 'SkillController')->only('index');                   //Skills Mananement API

        Route::group(['prefix' => 'statistic'], function () {
            Route::get('summary', 'StatisticController@bussinessStatisticize');
        });

    });
});

