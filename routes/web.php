<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('questions', 'Question\QuestionController');
    Route::post('/questions.table', 'Question\QuestionController@getTable')->name('questions.table');
    
    Route::get('user-tests', 'UserTest\UserTestController@index')->name('user-tests.index');
    Route::get('user-tests/load', 'UserTest\UserTestController@load')->name('user-tests.load');
    Route::post('user-tests/start', 'UserTest\UserTestController@start')->name('user-tests.start');
    Route::post('user-tests/{userTest}/answer', 'UserTest\UserTestController@answer')->name('user-tests.answer');
});
