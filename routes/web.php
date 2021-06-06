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
    
    // Question Routes
    Route::resource('questions', 'Question\QuestionController');
    Route::post('/questions.table', 'Question\QuestionController@getTable')->name('questions.table');
    
    // Test Admin Routes
    Route::get('user-tests/manage', 'UserTest\UserTestController@manageTests')->name('user-tests.manage');
    Route::post('user-tests/table', 'UserTest\UserTestController@getTable')->name('user-tests.table');

    // Test User Routes
    Route::get('user-tests', 'UserTest\UserTestController@index')->name('user-tests.index');
    Route::get('user-tests/{userTest}/show', 'UserTest\UserTestController@show')->name('user-tests.show');
    Route::get('user-tests/load', 'UserTest\UserTestController@load')->name('user-tests.load');
    Route::post('user-tests/start', 'UserTest\UserTestController@start')->name('user-tests.start');
    Route::post('user-tests/{userTest}/answer', 'UserTest\UserTestController@answer')->name('user-tests.answer');    
});
