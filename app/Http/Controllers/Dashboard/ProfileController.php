<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile()
    {
      $id = auth('admin')->user()->id;
      $admin = Admin::find($id);
      return view('dashboard.profile.edit', compact('admin'));
    }

    public function updateProfile(ProfileRequest $request){
        try {

            $admin = Admin::find($request->id);
            if ($request->filled('password')) {
                $request->merge(['password' =>bcrypt($request->password)]);
            }

            $admin->update($request->only('name', 'email' , 'password'));
            $admin->save();
            return redirect()->route('edit.profile')->with('success', 'Profile updated successfully');
        }catch (\Exception $exception){
            return redirect()->route('edit.profile')->with('error', 'Edit Failed');
        }
    }


}
