<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notification;
use App\Register;

class NotificationController extends Controller
{
    public function get_notifications()
    {	
        // get the notification count()
    	$count = DB::table('notifications')->where('status', '=', false)->count();

        // inner join the registers and notifications table to get the desire data
    	$notif = DB::table('notifications')  
    				->join('registers', 'notifications.register_id', '=', 'registers.id')
    				->select(
    					'notifications.register_id',
    					'notifications.title',
    					'notifications.description',
    					'notifications.date',
    					'registers.photo')
    				->orderBy('notifications.created_at', 'desc')
    				->limit(4)
    				->get();

    	return response()->json(['notifications' => $notif , 'count' => $count]); 
    }

    public function read_notifications()
    {   
        // update all to status true or 0
    	$read = DB::table('notifications')
                    ->where('status', false)
                    ->update([
    		              'status' => true
    	            ]);

    	return response()->json(['success' => 'Read Notifications'],200);
    }
}
