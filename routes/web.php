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

Route::get('/lawyer/login', 'Auth\LawyerController@showLoginForm')->name('lawyer.login');
Route::post('/lawyer/login', 'Auth\LawyerController@login')->name('lawyer.login.submit');
Route::get('/lawyer', 'LawyerController@index')->name('lawyer.dashboard');
