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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/test')
        ->group(function() {

            // API - Settings
            Route::get('/settings', 'SettingsApiController@get');


            // API - Pages
            Route::get('/getPages', 'PageApiController@get');
            Route::post('/postPages', 'PageApiController@post');

            
            // API - Users
            Route::get('/getUsers', 'UserApiController@get');
            Route::post('/postUsers', 'UserApiController@post');
});