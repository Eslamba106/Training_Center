<?php

namespace App\Http\Controllers\moderator;

use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('moderator.login.index');
    }

    public function login(Request $request)
    {
        if (auth()->guard('moderator')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('moderator.dashboard');
        };
        return back()->withErrors([
            'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
        ]);
    }

    public function logout()
    {
        auth()->guard('moderator')->logout();
        return redirect()->route('moderator.login.show');
    }
    public function settings_show()
    {
        $user = auth()->guard('moderator')->user();
        return view("moderator.settings.index" , ["user"=> $user]);
    }
    public function settings_edit()
    {
        $user = auth()->guard('moderator')->user();
        return view("moderator.settings.edit", ["user" => $user]);
    }
    public function settings_update(Request $request)
    {
        $user = auth()->guard('moderator')->user();
        $moderator = Moderator::find($request->id);
        if ($moderator) {
            $moderator->update([
                'name' => $request->name,
                'email' => $request->email,
                'section_id' => $user->section_id,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('moderator.settings.index')->with(["user"=> $user]);
        }
    }
}
