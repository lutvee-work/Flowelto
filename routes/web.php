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
Route::get('/add','GuestController@add')->middleware('auth','checkAdmin'); //view add flower
Route::post('/add','GuestController@store')->middleware('auth','checkAdmin'); //add flower
Route::get('/{id}/product/edit','GuestController@edit')->middleware('auth','checkAdmin'); //edit flower
Route::post('/{id}/product/update','GuestController@update')->middleware('auth','checkAdmin'); //update flower
Route::get('/{id}/product/delete','GuestController@destroy')->middleware('auth','checkAdmin'); //delete flower
Route::get('/categories','GuestController@categories')->middleware('auth','checkAdmin'); //view manage categories

Route::get('/{id}/categories/edit','GuestController@editCategories')->middleware('auth','checkAdmin'); //edit categories
Route::post('/{id}/categories/update','GuestController@updateCategories')->middleware('auth','checkAdmin'); //update categories
Route::get('/{id}/categories/delete','GuestController@destroyCategories')->middleware('auth','checkAdmin'); //delete categories