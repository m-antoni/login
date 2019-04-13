<?php
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
		Route::get('login', 'LoginQRCodeController@login')->name('user.login');
		Route::post('login', 'LoginQRCodeController@login_store')->name('user.login.store');
});

Route::prefix('admin')->group(function(){
		// Login Form
		Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login')->middleware('guest:admin');
		Route::post('/login', 'Auth\AdminLoginController@login')->name('login.post')->middleware('guest:admin');
		Route::get('/logout', 'Auth\AdminLoginController@adminLogout')->name('logout');

		Route::get('/dashboard', 'AdminsController@index')->name('dashboard')->middleware('auth:admin');
		// Register Users
		Route::get('/register', 'RegistersController@index')->name('register.index')->middleware('auth:admin');
		Route::get('/register/create', 'RegistersController@create')->name('register.create')->middleware('auth:admin');
		Route::post('/register/create/store', 'RegistersController@store')->name('register.store')->middleware('auth:admin');

		// download qrcode
		Route::get('register/download', 'RegistersController@downloadpage')->name('register.download')->middleware('auth:admin');
		Route::get('register/downloadfile', 'RegistersController@downloadfile')->name('register.downloadfile')->middleware('auth:admin');

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
		Route::delete('/logs/{logs}', 'LogsController@destroy')->name('log.delete')->middleware('auth:admin');



		Route::get('/qrcode', function(){
			 return QRCode::text('Michael_antoni')
							->setSize(10)
							->setMargin(2)
							->setOutFile(public_path('storage/testing.png'))
							->png();	
		});
    
		Route::get('/getqrcode', function(){
			 	// path file of qrcode.png
				$file = public_path('storage/testing.png');

				$headers = array(
					'Content-type: image/png'
				);
				// check if the file  exists
				$result = File::exists($file);

				if($result){
					// downlaod the file and delete it from orign directory
					return response()
								->download($file,'registered_file.png', $headers)
								->deleteFileAfterSend(true);
				}else{
					// redirect if there is no file
				}
		});


});


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');