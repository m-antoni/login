<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
    	// check if qrcode is registered
        $register = Register::where('qrcode', $request->qrcode)->firstOrFail();

        // check if the user is already log
        $user = Logs::where('qrcode', $register->qrcode)->first();

        $userNull = Logs::where('qrcode', $request->qrcode)
                             ->whereNull('time_out')
                             ->first();

        if($userNull){

            // Save time out data
            $userNull->time_out = Carbon::now();
            $userNull->status = 'Inactive';
            $userNull->save();
            // return response time out
            return response()->json(['message' => 'Time Out: ' . Carbon::now()->format('M j, Y | h:iA')]);

        }else{

            $latest = Logs::where('qrcode', $register->qrcode)->latest()->first();    
             // Check if time in is not today
            if(!$latest->time_in->isToday()){
                
                // Create new data
                
                $fullname = $register->first . ' ' . $register->last;

                // store in database
                $this->store_login($register->id, $request->qrcode, $fullname, Carbon::now());

                return response()->json(['message' => $fullname . ' Time In: ' . Carbon::now()->format('M j, Y | h:iA')]);

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
