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
    	// $notifications = DB::table('notifications')->select('register_id','title', 'description', 'date')->limit(4)->latest()->get();

    	$count = Notification::where('status', false)->count();

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
    	$read = Notification::where('status', false)->update([
    		'status' => true
    	]);

    	return response()->json(['success' => 'Read Notifications'],200);
    }
}
