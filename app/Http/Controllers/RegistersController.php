<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Register;

class RegistersController extends Controller
{
    public function index()
    {
    	return view('register.index');
    }

    public function create()
    {
    	return view('register.create');
    }
}
