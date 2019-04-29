<?php
/*
--------------------------------------------------------------------------
	Project Heirarchy  [ Login In System version 1.0 by Michael Antoni ]
--------------------------------------------------------------------------
	2019-03-14: Initial commit to the project
	2019-03-17: Create an Admin Guard Authentication
	2019-03-19: Route Model Bindings Implementation {RegistrationsController}
	2019-03-20: Revise the form UI 
	2019-03-22: Reusable Form and Route Binding Fix Bugs
	2019-03-30: File Image Upload Implementation
	2019-04-07: Create the index page ui
	2019-04-13: User Login Implementation UI and Functionality
	2019-04-16: Index page UI revised layout
	2019-04-21: Cannot Log In Twice Implementation {LoginQRCodeController}
	2019-04-28: Show User image in alert box
*/
use Carbon\Carbon;


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

		//	Code block only for testing purposes 

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

		// Carbon Testing
		Route::get('/carbon',function(){

				$now = Carbon::now()->setTimezone('Asia/Manila');
				$set = Carbon::createFromTime(20,00,00,'Asia/Manila');
				$toArray = Carbon::now()->setTimezone('Asia/Manila')->toArray();
				$isSameDay = !$now->isSameDay($now);
				$toFormattedDateString = $now->toFormattedDateString();
				$toDateString = $now->toDateString();
				$toDayDateTimeString = $now->toDayDateTimeString();
				$toTimeString = $now->toTimeString();
			
				$diffInHours = $now->diffInHours($set); // test interval hours late
				$diffInMinutes = $now->diffInMinutes($set); // test interval minutes late

  		//$manilaTime = Carbon::now('Asia/Manila')->format('h:iA M j, Y');
	  		// $create = Carbon::createFromTime(13,00,00);
	  		// // $isAfter = $now->isAfter($create);
				// $test = Carbon::create(2019,4,21,13,00,10)->format('h:iA M j, Y');
	  	// 	$diffInRealHours = $now->diffInRealHours($test);
	  	// 	$diffInHours = $now->diffInHours($test);
	  	// 	$diffForHumans = $now->diffForHumans($test);
	  	// 	$timespan = $now->timespan($test);
	  	// 	$sub = $now->sub('hour', '1')->format('h:iA'); // sub and add
	  		return dd([$now, $toFormattedDateString, $toDateString, $toDayDateTimeString, $toTimeString, $set, $diffInHours, $toArray]);
	  });

});


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');