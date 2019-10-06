<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Faker\Generator as Faker;
use App\Register;
use Validator;
use File;
use QRCode;

class RegistersController extends Controller
{
    public function index(Request $request)
    {   
        if($request->ajax()){
            $data = Register::latest()->get();
            return Datatables::of($data)
                 ->setRowId(function($user){
                return $user->id;
            })
            ->addColumn('action', function($row){
                $btn  = '<a href="register/'. $row->id .'" class="btn btn-sm btn-warning btn-circle">
                        <i class="fa fa-eye"></i></a>
                        <a href="register/' . $row->id .'/edit" class="btn btn-sm btn-primary btn-circle">
                        <i class="fa fa-edit"></i></a>
                        <a href="#" class="delete btn btn-sm btn-danger btn-circle" data-id=' . $row->id . '>
                        <i class="fa fa-trash"></i></a>
                        ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

    	$users = Register::all();

        return view('register.index', compact('users'));
    }

    public function create()
    {
        $department = $this->department();
        $register = new Register();

        return view('register.create', compact('department', 'register'));
    }

    public function store(Request $request)
    {   
        
        $rules = array(
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
            'id_number' => 'required|numeric'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            // return error
            return response()->json(['errors' => $error->errors()->all()]);

        }else{

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
                'id_number' => $request->id_number
            ]);

            return response()->json(['success' => 'Success!']);
        }
        
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
        }
    }

    public function show(Register $register)
    {   
        // dd($register->id);
        return view('register.show', compact('register'));
    }

    public function edit(Register $register)
    {
        $department = $this->department(); // get the department select

        return view('register.edit', compact('register', 'department')); 
    }

    public function update(Request $request, Register $register)
    {   
        
        $rules = array(
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
            'id_number' => 'required|numeric'
        );

        $error = Validator::make($request->all(), $rules);

          if($error->fails()){
            // return error
            return response()->json(['errors' => $error->errors()->all()]);

        }else{

            // Store data in database
            $register->update([
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
                'id_number' => $request->id_number
            ]);

            return response()->json(['success' => 'Success!']);
        }    

    }

    public function destroy(Register $register)
    {
        // remove if has photo
        if($register->photo != 'photos/default.jpg'){
            $path = public_path() . '/storage/' . $register->photo;
            unlink($path);
        }
        // delete the user
        $register->delete();

        // session()->flash('message', 'User has been deleted successfully');
        return response()->json(['success'=>'User deleted successfully.'],200);
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
