<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'auth'], function () {

    /**** GET ***/
    // users
    Route::get('/', 'WelcomeController@index');
    Route::get('/dash', 'DashboardController@index');

    Route::get('/logout',[
        'middleware' => 'role:public',
        'uses' => 'UserController@logout',
    ]);
    Route::get('user/profile',[
        'middleware' => 'role:public',
        'uses' => 'UserController@getUserProfile',
    ]);

    Route::get('/permission', 'UserController@listPermission');
    Route::get('/permission-add', 'UserController@addPermission');
    Route::get('/permission-edit/{permissionId}', 'UserController@editPermission');
    Route::get('/permission-remove/{permissionId}', 'UserController@removePermission');
    Route::get('/permission-add-user-group', [
        'middleware' => 'role:QLNQ-Update',
        'uses' => 'UserController@addUserGroupPermission',
    ]);

});

//GUEST ROLE
Route::group(['middleware' => 'guest'], function () {

    /**
     * GET request
     */
    Route::get('/login', 'UserController@login');


    Route::get('/error503', 'ErrorController@error503');
    Route::get('/forgot-pass-message', 'UserController@forgotPasswordMessage');
    Route::get('/renewpass/{token}', 'UserController@renewPassword');
    Route::get('/forgot-password', 'UserController@forgotPassword');
    Route::get('/captcha', 'UserController@captchamage');
    Route::get('/confirm-email/{token}', 'UserController@postConfirmEmail');
    /**
     * POST request
     */
    Route::post('/login', 'UserController@doLogin');
    Route::post('/post-forgot-password', 'UserController@postForgotPassword');
    Route::post('/renewpass/{token}', 'UserController@renewPassword');
    Route::post('/postrenewpass/{token}', 'UserController@postRenewPassword');
    Route::post('/post-register-agency', 'AgencyController@postRegisterAgency');

});