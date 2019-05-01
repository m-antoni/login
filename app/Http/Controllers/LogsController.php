<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Logs;

class LogsController extends Controller
{
	  public function index()
	  {
	  		// Logs table
		  	$logs = Logs::Ordered()->paginate(7);

				// time to beat 
		  	$setTimetoBeat = Carbon::create()->hour(9)->minute(0)->toTimeString();
		  	//$setTimetoBeat = Carbon::createFromTime(9,00,0,'Asia/Manila');

		  	// set a time to end 
		  	$setTimeToEnd = Carbon::create()->hour(18)->minute(0)->toTimeString();
		  	//$setTimeToEnd = Carbon::createFromTime(18,00,0,'Asia/Manila');

		  	return view('logs.index', compact(['logs', 'setTimetoBeat', 'setTimeToEnd']));
	  }

	  public function destroy(Logs $logs)
	  {
	  		$logs->delete();

	  		return redirect()->route('logs.index')->with('message', 'Log removed successfully');
	  }
}
