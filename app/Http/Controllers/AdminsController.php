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
			$register = Register::count();
			$logs = Logs::count();
			$active = Logs::where('status', 'Active')->count();
			$time = Carbon::now()->format('M j, Y h:iA');

			return view('dashboard.index', compact('register','logs', 'active', 'time'));
	}

}
