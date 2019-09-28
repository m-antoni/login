<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Validator;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.admin');
    }

    public function login(Request $request)
    {
        $rules = array(
            'username' => 'required|string',
            'password' => 'required|string',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);

        }else{

            // Attempt to log in using qrcode
            if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]))
            {
                //return ['redirect' => route('admin.dashboard')];
                $redirect = response(['redirect' => route('dashboard')], 200)                        
                                    ->header('Content-Type', 'text/plan');
                return $redirect;
            }

            // default response error
            $response = response(['status' => 'Unauthorized attempt to sign-in!'])
                                ->header('Content-Type', 'text/plan');
            return $response;
        }
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
