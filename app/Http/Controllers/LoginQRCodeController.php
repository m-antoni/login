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
        // carbon instance
    	$time = Carbon::now(); 
        // request qrcode
    	$qrcode = $request->qrcode; 

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

            // Check if 
            if(!$user->time_in->isToday()){
                
                // create new data for the same user
                $this->store_login($user->register_id, $request->qrcode, $user->name, $time);

                return response()->json(['message' => $user->name . ' Time In: ' . Carbon::now()->format('M j, Y | h:iA')]);

            }elseif($user->status == 'Active'){

                // Check first the time



                // Save time out data
                $user->time_out = $time;
                $user->status = 'Inactive';
                $user->save();
                // return response time out
                return response()->json(['message' => 'Time Out: ' . Carbon::now()->format('M j, Y | h:iA')]);

            }else{

                // if try to log in at the same date
                return response()->json(['error' => 'Sorry you cannot log in twice!']);
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
