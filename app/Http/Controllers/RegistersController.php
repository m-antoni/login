<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Faker\Generator as Faker;
use App\Register;
use File;
use QRCode;

class RegistersController extends Controller
{
    public function index()
    {
    	$users = Register::all();
        return view('register.index', compact('users'));
    }

    public function getUsers()
    {
        return DataTables::of(Register::query())

            ->addColumn('name', '{{$first}} {{$last}}')
            ->setRowId(function($user){
                return $user->id;
            })
            ->addColumn('action', function(Register $register){
                return '
                <a href='. route("register.show", $register->id) .' data-id=' . $register->id .' class="btn btn-primary btn-circle btn-sm">
                <i class="fa fa-eye"></i></a>
                <a href='. route("register.edit", $register->id) .' data-id=' . $register->id .' class="btn btn-warning btn-circle btn-sm">
                <i class="fa fa-edit"></i></a>
                <a href="#" data-id=' . $register->id .' class="btn btn-danger btn-circle btn-sm deletebtn">
                <i class="fa fa-trash"></i></a>';
            })
            ->toJson();
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

        // Validate the database
        $this->validateRequest();

        // Generate random string
        $passcode = str_random(60);

        // Generate QR Code
        $qrcode = QRCode::text($passcode)
                        ->setSize(10)
                        ->setMargin(2)
                        ->setOutFile(public_path('storage/temporary_qrcode.png'))
                        ->png();    

        // Store data in database
        $register = Register::create([
            'qrcode' => $passcode,
            'first' => $request->first,
            'last' => $request->last,
            'middle' => $request->middle,
            'age' => $request->age,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'department' => $request->department,
            'date_hired' => $request->date_hired,
            'user_type' => $request->user_type,
            'id_number' => $request->id_number,
            'photo' => $filenametoStore,
        ]);    

        return redirect()->route('register.download');
    }

    public function downloadpage()
    {
        return view('register.download');
    }

    public function downloadfile(){

        $headers = array('Content-type: image/png');

        // check if the file  exists
        $result = File::exists(public_path('storage/temporary_qrcode.png'));
        
        if($result){
            // download the file and delete it from storage directory
            return response()
                    ->download(public_path('storage/temporary_qrcode.png'),'generated-qrcode.png', $headers)
                    ->deleteFileAfterSend(true);
        }else{
            return redirect()->route('register.index');
        }
    }

    public function show(Register $register)
    {   
        return view('register.show', compact('register'));
    }

    public function edit(Register $register)
    {
        $department = $this->department(); // get the department select

        return view('register.edit', compact('register', 'department')); 
    }

    public function update(Register $register)
    {   
        // Validation and Update
        $register->update($this->validateRequest());

        session()->flash('message', 'User has been updated successfully');

        return redirect()->route('register.show', $register->id);
    }

    public function destroy(Register $register)
    {
        $register->delete(); // delete user

        session()->flash('message', 'User has been deleted successfully');

        return redirect()->route('register.index');
    }

    private function validateRequest()
    {
        // Validation code block
        return request()->validate([
            'first' => 'required',
            'last' => 'required',
            'middle' => 'nullable',
            'age' => 'required|numeric',
            'gender' => 'required',
            'birthday' => 'required|date',
            'contact' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'department' => 'required',
            'date_hired' => 'required|date',
            'user_type' => 'required',
            'id_number' => 'required|numeric',
            'photo' => 'image|nullable|max:1999',
        ]);
    }

    public function department()
    {
      // department select values in array  
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
