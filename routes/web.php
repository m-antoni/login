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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('login')->middleware('guest:admin');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit')->middleware('guest:admin');

Route::get('admin/admin', 'AdminsController@index')->name('admin.dashboard')->middleware('auth:admin');
Route::get('admin/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');


