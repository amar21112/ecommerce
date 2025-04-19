<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(){
        return view('dashboard.auth.login');
    }

    public function verifyAdmin(AdminLoginRequest $request){
        $remmember_me  = $request->has('remember_me') ? true : false;

        if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error'=>'something went wrong']);
    }
}
