<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        return view('student.login.index');
    }

    public function login(Request $request){
        if(auth()->guard('student')->attempt(['email'=>$request->input('email') , 'password'=>$request->input('password')])){
            return redirect()->route('student.dashboard');
        };
        return back()->withErrors([
            'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
        ]);
    }

    public function logout(){
        auth()->guard('student')->logout();
        return redirect()->route('user.login.show');
    }
}
