<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'API\V1', 'prefix' => 'v1', 'as' => 'api.v1.'], function () {

    Route::group(['middleware' => ['guest']], function () {

        Route::post('login', 'AuthController@login')->name('login');
    });

    Route::group(['middleware' => ['auth:api']], function () {

        Route::post('logout', 'AuthController@logout')->name('logout');

        // Test APIs
        Route::get('test/get-questions', 'TestApiController@getQuestions')->name('test.get-questions');
        Route::post('test/save-result', 'TestApiController@saveResult')->name('test.save-result');
    });
});
