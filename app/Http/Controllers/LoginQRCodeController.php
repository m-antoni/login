<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Register;
use App\Logs;

class LoginQRCodeController extends Controller
{
    public function login()
    {
    	return view('login.user');
    }

    public function login_store(Request $request)
    {
	    	$time = Carbon::now(); // carbon instance
	    	$qrcode = $request->qrcode; // request qrcode
	    	// check if qrcode is registered
        $register = Register::where('qrcode', $qrcode)->firstOrFail();
        // check if the user is already log
        $user = Logs::where('qrcode', $register->qrcode)->first();

        if(!$user){
        		// fullname
        		$fullname = $register->first . ' ' . $register->last;

        		// store in database
        		$this->store_login($register->id, $qrcode, $fullname, $time);

        		return response()->json(['message' => $fullname . ' Time In: ' . Carbon::now()->format('M j, Y | h:iA')]);

        }else{

        		if($user->status == 'Inactive'){

                return response()->json(['error' => 'Unauthorized attempt to Log...']);

           }else{

	              $user->time_out = $time;
	        			$user->status = 'Inactive';
	        			$user->save();

	        			return response()->json(['message' => 'Time Out: ' . Carbon::now()->format('M j, Y | h:iA')]);
           }
        			
        }
    }

    public function store_login($id, $qrcode, $fullname, $time)
    {
        $log = Logs::create([
        		'register_id' => $id,
        	  'qrcode' => $qrcode,
            'name' => $fullname,
            'time_in'=> $time,
            'time_out' => null,
            'status' => 'Active'
        ]);
    }
}

// SAnztLd5vJa9rtYCRHH3IjMzeRRSNt2f6M0ZJTJeTNVyqGBnrsvnW4vZPmio
