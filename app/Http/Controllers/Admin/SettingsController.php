<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index(){
        $settings = Settings::first();
        return view('admin.settings.index' , compact('settings'));
    }

    public function edit()
    {
    $settings = Settings::first();
    return view('admin.settings.edit' , compact('settings'));
}
    public function update(Request $request){
        // $request->validate([
        //     'facebook' => "required|string|max:255",
        //     "x" => "required|string|max:255",
        //     "linked_in" => "required",
        //     "instagram" => "required",
        //     "phone" => "required",
        //     "email" => "required",
        // ]);
        // dd($request->all());
        $setting = Settings::first();

        // dd($new_image);
        $setting->update($request->all());

        return redirect()->route('admin.settings');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('logo')) {
            return;
        } else {
            $file = $request->file('logo');
            $path = $file->store('settings', [
                'disk' => 'public',
            ]);
            return $path;
        }
    }
}
