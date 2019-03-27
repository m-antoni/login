<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\REgister;

class UploadPhotoController extends Controller
{
   public function index(Register $register)
   {
   		return view('upload.index', compact('register'));
   }
}
