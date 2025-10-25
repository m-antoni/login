<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Register;
use App\Logs;
use Illuminate\Support\Facades\Auth;


class AdminsController extends Controller
{
	public function index()
	{
		//dd(Auth::guard('admin')->check(), Auth::guard('admin')->user());

		// Initial Carbon instance set timezone to Asia/Manila
		$time = Carbon::now()->setTimezone('Asia/Manila')->format('h:iA M j, Y');

		// Total Register count
		$register = Register::count();

		// Total logs count
		$logs = Logs::count();

		// Total Lates
		$lates = Logs::sum('late');

		// Total Under Time
		$under = Logs::sum('under');

		// Total Employee
		$employees = Register::where('user_type', 'Employee')->count();

		// Total Intern
		$interns = Register::where('user_type', 'Intern')->count();

		// Actice today
		$active = Logs::whereDate('log_in', now())
										->where('status', 1)
										->count();

		// Inactive today
		$inactive = Logs::whereDate('log_out', now())
										->where('status', 0)
										->count();

		// Late time today
		$lateToday = Logs::where('late','>', 0)
										->whereDate('log_in', now())
										->count();

		// Under time today								
		$underTimeToday = Logs::where('under', '>', 0)
										->whereDate('log_out', now())
										->count();

		return view('dashboard.index', compact(['time','register','logs', 'lates','under','employees','interns','active', 'inactive', 'lateToday', 'underTimeToday']));
	}

	public function employees()
	{
		$employees = Register::where('user_type', 'Employee')->orderBy('created_at', 'DESC')->paginate(7);

		return view('dashboard.employees', compact('employees'));
	}

	public function interns()
	{
		$interns = Register::where('user_type', 'Intern')->orderBy('created_at', 'DESC')->paginate(7);

		return view('dashboard.interns', compact('interns'));
	}
	public function tester()
	{
		return view('pages.tester');
	}

	public function about()
	{
		$info = [
			'title' => 'About',
			'github' => 'www.github.com/m-antoni',
			'email' => 'michaelantoni.tech@gmail.com',
			'name' => 'Michael Antoni',
		];
		return view('pages.about', compact('info'));
	}
}
