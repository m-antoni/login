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
	  	$logs = Logs::orderBy('created_at', 'desc')->paginate(5);

	  	return view('logs.index', compact('logs'));
	  }
}
