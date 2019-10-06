<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Register;
use Validator;

class UploadPhotoController extends Controller
{
   public function index(Register $register)
   {	    
   		return view('upload.index', compact('register'));
   }

   public function update(Request $request)
   {  
      // validate data
      $rules = array(
			'photo' => 'required|image|mimes:jpeg,jpg,png|max:5999',
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails()){
			// return errors response
			return response()->json(['errors' => $error->errors()->all()]);

		}else{

			// Save the path and storage
			Register::where('id', $request->id )->update([
						'photo' => $request->photo->store('photos','public')
					]);

			$user = Register::find($request->id);

			return response()->json(['success' => 'Image Uploaded Successfully!', 'path' => $user->photo]);
		}
   }

   public function destroy($id)
   {	
   		$user = Register::find($id);
   		// dd($user->id);

   		// delete the user image file
   		$path = public_path() . '/storage/' . $user->photo;
 		   unlink($path);
 		
 		   $new_path = 'photos/default.jpg';
   	  	// update the path to default.jpg
	   	Register::find($id)->update(['photo' => $new_path ]);

   		return response()->json(['success' => 'Deleted Image', 'path' => $new_path]);
   }
}
