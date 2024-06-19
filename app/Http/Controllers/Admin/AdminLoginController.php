<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login.index');
    }

    public function login(Request $request){
        if(auth()->guard('admin')->attempt(['email'=>$request->input('email') , 'password'=>$request->input('password')])){
            return redirect()->route('admin.dashboard');
        };
        return back()->withErrors([
            'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
        ]);
    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }
}
