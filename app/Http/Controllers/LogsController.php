<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Logs;
use App\Register;

class LogsController extends Controller
{
	public function index()
	{
			// Logs table
	  	$logs = Logs::Ordered()->paginate(7);
			// time to beat 
	  	// $setTimetoBeat = Carbon::create()->hour(9)->minute(0)->toTimeString();
	  	//$setTimetoBeat = Carbon::createFromTime(9,00,0,'Asia/Manila');

	  	// set a time to end 
	  	// $setTimeToEnd = Carbon::create()->hour(18)->minute(0)->toTimeString();
	  	//$setTimeToEnd = Carbon::createFromTime(18,00,0,'Asia/Manila');

	  	return view('logs.index', compact(['logs']));
	}

	public function destroy(Logs $logs)
	{
		$logs->delete();

		return redirect()->route('logs.index')->with('message', 'Log removed successfully');
	}

	 public function late()
	{
		$lates = Logs::whereDate('log_in', now())->orderBy('created_at', 'DESC')->paginate(7);

		return view('logs.late', compact('lates'));
	}	

	public function under()
	{
		$under = Logs::whereDate('log_out', now())->orderBy('created_at', 'DESC')->paginate(7);

		return view('logs.under', compact('under'));
	}
							
	public function active()
	{
		$activeUsers = Logs::whereDate('log_in', now())
											->where('status', 1)
											->orderBy('created_at', 'DESC')
											->paginate(7);

		return view('logs.active', compact('activeUsers'));
	}

	public function inactive()
	{
		$inactiveUsers = Logs::whereDate('log_out', now())
											->where('status', 0)
											->orderBy('created_at', 'DESC')
											->paginate(7);

		return view('logs.inactive', compact('inactiveUsers'));
	}

}
