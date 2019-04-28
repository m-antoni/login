<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Register;

class UploadPhotoController extends Controller
{
   public function index(Register $register)
   {	
   		return view('upload.index', compact('register'));
   }

   public function update(Request $request, Register $register)
   {
   		request()->validate([
   				'photo' => 'required|image|max:1999'
   		]);

   		// Get the extension 
			//$request->photo->extension();
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
	        // If no image is uploaded
	        $filenametoStore = 'default.jpg';
	    }
   		
   		// store in database
	    $photo = Register::where('id', $register->id)
										    ->update([
										    	'photo' => $filenametoStore,
										    ]);

	    return redirect()->route('register.show', $register->id);
   }

   public function destroy(Register $register)
   {
   		// delete the user image file
   		$deleteImage = Storage::delete('public/photos/' . $register->photo);
 
   	  // update the path to default.jpg
	   	$update = Register::where('id', $register->id)
							    				->update(['photo' => 'default.jpg',]);

   		return redirect()->route('register.show', $register->id);
   }
}
