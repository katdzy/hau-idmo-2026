<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;

class UpdatesController extends Controller
{
    public function updatePic(Request $request, $id)
    { 
        $emp = Employee::findOrFail(Auth::user()->id);

        // Validate that either a file or a base64-cropped image is present
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'cropped_image'   => 'nullable|string'
        ]);

        // Delete old picture if any
        if($emp->profile_picture) {
            Storage::disk('public')->delete('profile_pictures/' . $emp->profile_picture);
        }

        // If there's a base64 cropped image, decode it and store
        if($request->filled('cropped_image')) {
            $base64Data = $request->input('cropped_image');

            // Example: data:image/png;base64,iVBORw0KGgoAAAANS...
            // We need to parse out the extension and decode
            @list($type, $data) = explode(';', $base64Data);
            @list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            // Decide on extension
            $extension = 'png';
            if (str_contains($type, 'image/jpeg') || str_contains($type, 'image/jpg')) {
                $extension = 'jpg';
            }

            $filename = $id.'.'.$extension;
            Storage::disk('public')->put('profile_pictures/'.$filename, $data);
            
            $emp->update([
                'profile_picture' => $filename
            ]);
        }
        else if($request->hasFile('profile_picture')) {
            // If no cropped_image is provided, fallback to raw file upload
            $fileExtension = $request->file('profile_picture')->getClientOriginalExtension();
            $filename = $id . '.' . $fileExtension;

            $request->file('profile_picture')
                    ->storeAs('profile_pictures', $filename, 'public');

            $emp->update([
                'profile_picture' => $filename
            ]);
        }

        session(['userInfo'=>$emp]);
        session(['changed'=>true]);

        return Redirect::route('profile.edit')
                       ->with(['status'=> 'profile-updated', 'changedp'=> false]);
    }
}
