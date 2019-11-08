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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/book-catalog', 'CheckoutsController@index');

Route::get('/checked-out', 'CheckoutsController@show');

Route::get('/available', 'CheckoutsController@available');

Route::post('/book-catalog', 'CheckoutsController@create');

Route::post('/books/checkout', 'CheckoutsController@checkout');

Route::delete('/books/checkout', 'CheckoutsController@destroy');

Route::delete('/books/remove', 'CheckoutsController@remove');