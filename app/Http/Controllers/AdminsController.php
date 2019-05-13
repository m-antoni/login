<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Register;
use App\Logs;

class AdminsController extends Controller
{
	public function index()
	{
			//return dd(Logs::whereDate('log_in', now())->count());

			$time = Carbon::now()->setTimezone('Asia/Manila')->format('h:iA','M j, Y');

			$register = Register::count();
			$logs = Logs::count();

			$active = Logs::where('status', 1)->count();

			$inactive = Logs::whereDate('log_out', now())
											->where('status', 0)
											->count();

			$lateToday = Logs::whereDate('log_in', now())->count();
			$underTimeToday = Logs::whereDate('log_out', now())->count();

			return view('dashboard.index', compact('time','register','logs', 'active', 'inactive', 'lateToday', 'underTimeToday'));
	}

	public function late()
	{
		$lates = Logs::whereDate('log_in', now())->paginate(7);

		return view('dashboard.late', compact('lates'));
	}

	public function under()
	{
		$under = Logs::whereDate('log_out', now())->paginate(7);

		return view('dashboard.under', compact('under'));
	}
}
