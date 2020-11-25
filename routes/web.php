<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// global
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'GuestController@index');
Route::get('/{id}/product','GuestController@show');
Route::get('/{id}/detail','GuestController@detail');

//manager
Route::get('/manager', 'HomeController@manager')->middleware('auth','checkAdmin');
Route::get('/{id}/product/edit','GuestController@edit'); //edit flower
Route::post('/{id}/product/update','GuestController@update'); //update flower
Route::get('/{id}/product/delete','GuestController@destroy'); //delete flower