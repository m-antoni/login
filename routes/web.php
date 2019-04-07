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


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

/*
--------------------------------------------------------------------------
 	Project Heirarchy 
--------------------------------------------------------------------------
	2019-03-17: Admin Guard Authentication
	2019-03-21: Reusable Form and Route Binding Fix
	2019-03-30: File Upload Implementation
 
*/

Route::prefix('/')->group(function(){
		Route::view('', 'welcome')->name('home');
		Route::view('login', 'user.index')->name('user.login');
});

Route::prefix('admin')->group(function(){
		// Login Form
		Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login')->middleware('guest:admin');
		Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit')->middleware('guest:admin');
		Route::get('/logout', 'Auth\AdminLoginController@adminLogout')->name('logout');

		Route::get('/dashboard', 'AdminsController@index')->name('dashboard')->middleware('auth:admin');
		// Register Users
		Route::get('/register', 'RegistersController@index')->name('register.index')->middleware('auth:admin');
		Route::get('/register/create', 'RegistersController@create')->name('register.create')->middleware('auth:admin');
		Route::post('/register/create/store', 'RegistersController@store')->name('register.store')->middleware('auth:admin');
		Route::get('/register/{register}', 'RegistersController@show')->name('register.show')->middleware('auth:admin');
		Route::get('/register/{register}/edit', 'RegistersController@edit')->name('register.edit')->middleware('auth:admin');
		Route::patch('/register/{register}', 'RegistersController@update')->name('register.update')->middleware('auth:admin');
		Route::delete('/register/{register}', 'RegistersController@destroy')->name('register.delete')->middleware('auth:admin');

		// Upload Photo
		Route::get('/register/{register}/photo', 'UploadPhotoController@index')->name('upload')->middleware('auth:admin');
		Route::patch('/register/{register}/update', 'UploadPhotoController@update')->name('upload.update')->middleware('auth:admin');
		Route::patch('/register/{register}/photo', 'UploadPhotoController@destroy')->name('upload.delete')->middleware('auth:admin');
		
		// LogsController
		Route::get('/logs', 'LogsController@index')->name('logs.index')->middleware('auth:admin');
});
