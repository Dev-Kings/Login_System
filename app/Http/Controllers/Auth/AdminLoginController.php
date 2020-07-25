<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
public function __construct(){
    //$this->middleware('guest:admin')->except('logout');
    $this->middleware('guest')->except('logout');
    //$this->middleware('guest:admin')->except('logout');
}

    public function showLoginForm(){
        return view('auth.admin-login');
    }
    public function login(Request $request){
        //validate the form data
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
    //Attempt to log in user
    //dd($request);
    if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)) {
        //if successful,redirect to intended
        return redirect()->intended(route('admin.dashboard'));
        //dd($request);
    }
//if unsuccessful redirect back to login form with data
        return redirect()->back()->withInput($request->only('email','remember'));
}
}
