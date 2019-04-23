<?php

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

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::resources([
    'json' => 'JSONController'
    //,'posts' => 'PostController'
]);

// Auth

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/datosMoto', 'DinamoController@ejemplo');
Route::get('/async', 'AsyncController@getView');