<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Register;

class RegistersController extends Controller
{
    public function index()
    {
    	$registers = Register::orderBy('created_at', 'DESC')->paginate(7);

        return view('register.index', compact('registers'));
    }

    public function create()
    {
        $department = $this->department();
        $register = new Register();

        return view('register.create', compact('department', 'register'));
    }

    public function store(Request $request)
    {   
    
        if($request->hasFile('photo')){
            // Get filename with the extension
            $filenamewithExtension = $request->photo->getClientOriginalName();
            // Get filesize
            $fileSize = $request->photo->getClientSize();
            // Get just filename
            $filename = pathinfo($filenamewithExtension, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Filename to store
            $filenametoStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('photo')->storeAs('public/photos', $filenametoStore); 

        }else{
            // set the default image file
            $filenametoStore = 'default.jpg';
        }

        $this->validateRequest();

        // Store in database
        $register = Register::create([
            'first' => $request->first,
            'last' => $request->last,
            'middle' => $request->middle,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'department' => $request->department,
            'date_hired' => $request->date_hired,
            'user_type' => $request->user_type,
            'id_number' => $request->id_number,
            'password' => $request->password,
            'photo' => $filenametoStore,
        ]);    

        session()->flash('message', 'New user has been successfully added');
        
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
        // Validation and Store in database
        $register->update($this->validateRequest());

        session()->flash('message', 'User has been updated successfully');

        return redirect()->route('register.show', $register->id);
    }

    public function destroy(Register $register)
    {
        $register->delete();

        session()->flash('message', 'User has been deleted successfully');

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
            'password' => 'required|min:6',
            'photo' => 'image|nullable|max:1999',
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
