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
        // set timezone to Asia/Manila
        $time = Carbon::now()->setTimezone('Asia/Manila');
    	// check if qrcode is registered
        $register = Register::where('qrcode', $request->qrcode)->firstOrFail();
        // user image path                    
        $imageURL = asset('/storage/photos/' . $register->photo);
        // check if user has log in 
        $oldUser = Logs::where('qrcode', $register->qrcode)
                             ->whereNull('log_out')
                             ->first();
                                
        if($oldUser){
            // set a time to end 6:00PM
            $setTimeToEnd = Carbon::createFromTime(18,00,00,'Asia/Manila');

            // not greater than set time to end
            if(!$time->copy()->greaterThan($setTimeToEnd)){
                // is under time
                $oldUser->log_out = $time;
                $oldUser->under = $time->diffInHours($setTimeToEnd);
                $oldUser->status = 0;
                $oldUser->save();

                return response()->json(['wrong' => 'Under Time: ' . $time->format('h:iA M j, Y'),'image' => $imageURL]);
            }else{
                // is correct time out
                $oldUser->log_out = $time;
                $oldUser->under = 0;
                $oldUser->status = 0;
                $oldUser->save();

                return response()->json(['message' => 'Logged out: ' . $time->format('h:iA M j, Y'),'image' => $imageURL]);
            }
            
         // Check if user has logs  
        }elseif(Logs::where('qrcode', $register->qrcode)->exists()){
            // Get user's time in and check if today this will return true
            $latest = Logs::where('qrcode', $register->qrcode)->latest()->first()->log_in->isToday();

            // is not today and not sunday
            if(!$latest){ // && !$time->isSunday()
                // fullname
                $fullName = $register->getFullNameAttribute();

                // time to beat is 9:00AM
                $setTimetoBeat = Carbon::createFromTime(9,00,00,'Asia/Manila');

                // condition late or not
                if($time->isAfter($setTimetoBeat)){
                    // get the late
                    $late = $time->diffInHours($setTimetoBeat);

                    // store in database to create new data
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);

                    // is late
                    return response()->json(['wrong' => 'Late in: ' . $time->format('h:iA M j, Y'),'image' => $imageURL]);
                }else{
                    // not late
                    $late = 0;

                    // store in database to Create new data
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);

                    // not late
                    return response()->json(['message' => 'Logged in: ' . $time->format('h:iA M j, Y'),'image' => $imageURL]);
                }  

            }else{
                // return responses if sunday or log in twice
                return $time->isSunday() ? 
                        response()->json(['error' => 'Cannot log in during sunday!']) : 
                        response()->json(['error' => 'Unauthorized to log in twice!']);  
            }

        }else{
            // doesen't exists in logs and not sunday
            if(!$time->isSunday()){
                // fullname
                $fullName = $register->getFullNameAttribute(); 

                // time to beat is 9:00AM
                $setTimetoBeat = Carbon::createFromTime(9,00,00,'Asia/Manila');

                // condition returns true
                if($time->isAfter($setTimetoBeat)){
                    // get the late
                    $late = $time->diffInHours($setTimetoBeat);
                    // store in database to Create new data
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);

                    // is late
                    return response()->json(['wrong' => 'Late in: ' . $time->format('h:iA M j, Y'),'image' => $imageURL]);
                }else{
                    // set late to null
                    $late = null;
                    // store in database to Create new data
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);

                    // not late
                    return response()->json(['message' => 'Logged in: ' . $time->format('h:iA M j, Y'),'image' => $imageURL]);
                }
            }else{
                // cannot log in new user during sunday
                return response()->json(['error' => 'Cannot log in during sunday!']);
            }
        }
    }

    public function store_login($id, $qrcode, $fullname, $time, $late)
    {
        $log = Logs::create([
        	'register_id' => $id,
        	'qrcode' => $qrcode,
            'name' => $fullname,
            'log_in'=> $time,
            'log_out' => null,
            'late' => $late,
            'status' => 1
        ]);
    }
}

/* 
    michael: ZG45GSLiaXiB3UclOrKZNY6nGwHVjBxis1MhOQxGBTzrGjRUhQ8uOc0nPcUc
    bruce: 7ecSHaTtJ8ERFxcU0HcPGiQefCwQ285Us7wYJofVcPoYAFEH5IAOVw4Lxlby
    sansa: W8fUCgcOK6DuciawVislkQPCFKnm0K7wEECpmK34KakYlQq4epE50l93BN0u
*/