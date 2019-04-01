<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Register;

class UserLoginController extends Controller
{
    public function index()
    {
    	return view('login.user');
    }

    public function store()
    {
    	dd(request());
    }
}
