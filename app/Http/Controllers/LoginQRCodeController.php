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
        $time = Carbon::now('Asia/Manila'); //set timezone to manila

    	// check if qrcode is registered
        $register = Register::where('qrcode', $request->qrcode)->firstOrFail();

        // check if the user is already log
        $user = Logs::where('qrcode', $register->qrcode)->first();

        // check user has time in
        $oldUser = Logs::where('qrcode', $request->qrcode)
                             ->whereNull('time_out')
                             ->first();
        // user image path                    
        $imageURL = asset('/storage/photos/' . $register->photo); 
                                
        if($oldUser){
            // Save time out datas
            $oldUser->time_out = $time;
            $oldUser->status = 'Inactive';
            $oldUser->save();
            // return response time out
            return response()->json(['message' => 'Logged out: ' . $time->format('h:iA M j, Y'), 'image' => $imageURL]);

        }else{

            // Get the latest log of the qrcode
            $latest = Logs::where('qrcode', $register->qrcode)->latest()->first();    
            
            // Check if time in is not today
            if(!$latest->time_in->isToday() && !$time->isSunday()){
                // fullname
                $fullname = $register->first . ' ' . $register->last; 

                // store in database to Create new data
                $this->store_login($register->id, $request->qrcode, $fullname, $time);

                // time to beat
                $hour = Carbon::createFromTime(13,00,00);
                
                // condition returns true
                if($isAfter = $time->isAfter($hour)){
                    // is late
                    return response()->json(['late' => 'Late in: ' . $time->format('h:iA M j, Y'), 
                                            'image' => $imageURL]);
                }else{
                    // not late
                    return response()->json(['message' => 'Logged in: ' . $time->format('h:iA M j, Y'),
                                            'image' => $imageURL]);
                }

            }else{

                return $time->isSunday() ? 
                        response()->json(['error' => 'Cannot log in during sunday!']) : 
                        response()->json(['error' => 'Unauthorize to log in twice!']);  

                //return response()->json(['error' => 'Unauthorize to log in twice!']);
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
