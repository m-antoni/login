<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Register;

class RegistersController extends Controller
{
    public function index()
    {
    	$registers = Register::orderBy('created_at', 'DESC')->get();

        return view('register.index', compact('registers'));
    }

    public function create()
    {
        $department = $this->department();
        $register = new Register();

        return view('register.create', compact('department', 'register'));
    }

    public function store()
    {   
        Register::create($this->validateRequest());

        return redirect()->route('register.index');
    }

    public function show(Register $register)
    {
        return view('register.show', compact('register'));
    }

    public function edit(Register $register)
    {
        $department = $this->department();

        return view('register.edit', compact('register', 'department')); 
    }

    public function update(Register $register)
    {
        $register->update($this->validateRequest());

        return redirect()->route('register.show', $register->id);
    }

    public function destroy(Register $register)
    {
        $register->delete();

        return redirect()->route('register.index');
    } 

    private function validateRequest()
    {
        // Validate the form data
        return request()->validate([
            'first' => 'required',
            'last' => 'required',
            'middle' => 'nullable',
            'gender' => 'required',
            'birthday' => 'required|date',
            'contact' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'department' => 'required',
            'date_hired' => 'required|date',
            'user_type' => 'required',
            'id_number' => 'required',
            'password' => 'required|min:6'
        ]);
    }

    public function department()
    {
      return [
         '0' => 'President\'s Office',
         '1' => 'Finance',
         '2' => 'Accounting',
         '3' => 'Purchasing',
         '4' => 'IT Dept',
         '5' => 'Design & Engineering',
         '6' => 'Human Resource',
         '7' => 'Maintenance',
         '8' => 'Security',
        ];
    }
}
