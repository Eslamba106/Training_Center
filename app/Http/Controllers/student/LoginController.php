<?php

namespace App\Http\Controllers\student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('student.login.index');
    }

    public function login(Request $request){
        if(auth()->guard('student')->attempt(['email'=>$request->input('email') , 'password'=>$request->input('password')])){
            return redirect()->route('student.dashboard');
        }elseif(auth()->guard('student')->attempt(['phone'=>$request->input('email') , 'password'=>$request->input('password')])){
            return redirect()->route('student.dashboard');
        };
        return back()->withErrors([
            'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
        ]);
    }

    public function logout(){
        auth()->guard('student')->logout();
        return redirect()->route('student.login.show');
    }
    public function settings_show()
    {
        $user = auth()->guard('student')->user();
        return view("student.settings.index" ,["user"=> $user]);
    }
    public function settings_edit()
    {
        $user = auth()->guard('student')->user();
        return view("student.settings.edit", ["user" => $user]);
    }
    public function settings_update(Request $request)
    {
        $user = auth()->guard('student')->user();
        $student = Student::find($request->id);
        if ($student) {
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'section_id' => $user->section_id,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('student.settings.index')->with(["user"=> $user]);
        }
    }
}
