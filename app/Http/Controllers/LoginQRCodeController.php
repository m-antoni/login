<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Register;
use App\Logs;
use App\Notification;

class LoginQRCodeController extends Controller
{
    public function login()
    {
    	return view('login.user');
    }

    public function login_store(Request $request)
    {
       
        // Set timezone to Asia/Manila
        $time = Carbon::now()->setTimezone('Asia/Manila');
    
        // Check if QR code is registered
        $register = Register::where('qrcode', $request->qrcode)->firstOrFail();
    
        // User image path
        $imageURL = asset('/storage/' . $register->photo);
    
        // Check if user is already logged in (no log_out yet)
        $oldUser = Logs::where('qrcode', $register->qrcode)
                       ->whereNull('log_out')
                       ->first();
    
        // Full name
        $fullName = $register->getFullNameAttribute();
    
        // If user already has an active login
        if ($oldUser) {
            $setTimeToEnd = Carbon::createFromTime(18, 0, 0, 'Asia/Manila');
    
            if (!$time->copy()->greaterThan($setTimeToEnd)) {
                // Under time
                $oldUser->log_out = $time;
                $oldUser->under = $time->diffInHours($setTimeToEnd);
                $oldUser->status = 0;
                $oldUser->save();
    
                $this->send_notification($register->id, $fullName, 'Under Time: ' . $time->format('h:i A'), $time->format('F j, Y'));
                return response()->json(['wrong' => 'Under Time: ' . $time->format('h:iA M j, Y'), 'image' => $imageURL]);
            } else {
                // Correct time-out
                $oldUser->log_out = $time;
                $oldUser->under = 0;
                $oldUser->status = 0;
                $oldUser->save();
    
                $this->send_notification($register->id, $fullName, 'Logged out: ' . $time->format('h:i A'), $time->format('F j, Y'));
                return response()->json(['message' => 'Logged out: ' . $time->format('h:iA M j, Y'), 'image' => $imageURL]);
            }
    
        // If user has previous logs
        } elseif (Logs::where('qrcode', $register->qrcode)->exists()) {
    
            $latestLog = Logs::where('qrcode', $register->qrcode)->latest()->first();
    
            // Safely check if latest log-in is today
            $latestIsToday = $latestLog ? Carbon::parse($latestLog->log_in)->isToday() : false;
    
            if (!$latestIsToday) {
                $setTimetoBeat = Carbon::createFromTime(9, 0, 0, 'Asia/Manila');
    
                if ($time->isAfter($setTimetoBeat)) {
                    $late = $time->diffInHours($setTimetoBeat);
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);
    
                    $this->send_notification($register->id, $fullName, 'Late in: ' . $time->format('h:i A'), $time->format('F j, Y'));
                    return response()->json(['wrong' => 'Late in: ' . $time->format('h:i A M j, Y'), 'image' => $imageURL]);
                } else {
                    $late = 0;
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);
    
                    $this->send_notification($register->id, $fullName, 'Logged in: ' . $time->format('h:i A'), $time->format('F j, Y'));
                    return response()->json(['message' => 'Logged in: ' . $time->format('h:i A M j, Y'), 'image' => $imageURL]);
                }
    
            } else {
                // Unauthorized multiple login or Sunday restriction
                $this->send_notification($register->id, $fullName, 'Unauthorized Attempt', $time->format('h:i A F j, Y'));
    
                return $time->isSunday()
                    ? response()->json(['error' => 'Cannot log in during Sunday!'])
                    : response()->json(['error' => 'Unauthorized to log in twice!']);
            }
    
        // If user has no logs yet
        } else {
            if (!$time->isSunday()) {
                $setTimetoBeat = Carbon::createFromTime(9, 0, 0, 'Asia/Manila');
    
                if ($time->isAfter($setTimetoBeat)) {
                    $late = $time->diffInHours($setTimetoBeat);
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);
    
                    $this->send_notification($register->id, $fullName, 'Late in: ' . $time->format('h:i A'), $time->format('F j, Y'));
                    return response()->json(['wrong' => 'Late in: ' . $time->format('h:i A M j, Y'), 'image' => $imageURL]);
                } else {
                    $late = null;
                    $this->store_login($register->id, $request->qrcode, $fullName, $time, $late);
    
                    $this->send_notification($register->id, $fullName, 'Logged in: ' . $time->format('h:i A'), $time->format('F j, Y'));
                    return response()->json(['message' => 'Logged in: ' . $time->format('h:i A M j, Y'), 'image' => $imageURL]);
                }
            } else {
                return response()->json(['error' => 'Cannot log in during Sunday!']);
            }
        }
    }

    
    public function store_login($id, $qrcode, $fullname, $time, $late)
    {
        // Ensure $time is stored as a proper datetime string
        Logs::create([
            'register_id' => $id,
            'qrcode'      => $qrcode,
            'name'        => $fullname,
            'log_in'      => $time instanceof \Carbon\Carbon ? $time->toDateTimeString() : $time,
            'log_out'     => null,
            'late'        => $late ?? 0,
            'status'      => 1,
        ]);
    }
    
    public function send_notification($id, $title, $description, $date)
    {
        // Ensure $date is always a consistent format
        Notification::create([
            'register_id' => $id,
            'title'       => $title,
            'description' => $description,
            'date'        => $date instanceof \Carbon\Carbon ? $date->toDateString() : $date,
        ]);
    }
    
}
