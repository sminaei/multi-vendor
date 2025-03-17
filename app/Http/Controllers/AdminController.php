<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email'){
            $request->validate([
                'login_id' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:45'
            ],[
                'login_id.required' => 'email/username is required',
                'login_id.email' => 'invalid email address',
                'login_id.exists' => ' email is not exist',
                'password.required' => ' password is required',
            ]);
        }else{
            $request->validate([
                'login_id' => 'required|exists:admins,username',
                'password' => 'required|min:5|max:45'

            ],[
                'login_id.required' => 'email/username is required',
                'login_id.exists' => ' username is not exist',
                'password.required' => ' password is required',
            ]);
        }
        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password
        );
        if (Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.home');
        }else{
            session()->flash('fail','Incorrect credentials');
            return redirect()->route('admin.login');
        }
    }
    public function logoutHandler(){
        Auth::guard('admin')->logout();
        session()->flash('fail','you are logged out');
        return redirect()->route('admin.login');
    }
}
