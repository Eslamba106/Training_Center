<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\StudentsEmailImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
    public function settings_show()
    {
        $user = auth()->guard('admin')->user();
        return view("admin.login_settings.index" , ["user"=> $user]);
    }
    public function settings_edit()
    {
        $user = auth()->guard('admin')->user();
        return view("admin.login_settings.edit", ["user" => $user]);
    }
    public function settings_update(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $admin = Admin::find($request->id);
        if ($admin) {
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('admin.login_settings.index')->with(["user"=> $user]);
        }
    }

    public function import_excel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx',
        ]);
    
        $file_name = $request->file("file");
        Excel::queueImport(new StudentsEmailImport() , $file_name);
        return redirect()->back()->with("success","Imported");
    }
}
