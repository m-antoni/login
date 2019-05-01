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
			$active = Logs::where('status', 1)->count();
			$inactive = Logs::where('status', 0)->count();

			return view('dashboard.index', compact('register','logs', 'active', 'inactive'));
	}

}
