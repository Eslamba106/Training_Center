<?php

namespace App\Http\Controllers\moderator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        return view('moderator.login.index');
    }

    public function login(Request $request){
        if(auth()->guard('moderator')->attempt(['email'=>$request->input('email') , 'password'=>$request->input('password')])){
            return redirect()->route('moderator.dashboard');
        };
        return back()->withErrors([
            'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
        ]);
    }

    public function logout(){
        auth()->guard('moderator')->logout();
        return redirect()->route('moderator.login.show');
    }
}
