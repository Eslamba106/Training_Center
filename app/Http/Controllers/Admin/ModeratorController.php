<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ModeratorController extends Controller
{
    public function index()
    {
        $moderators = Moderator::get();
        $sections = Section::get();
        return view('admin.moderator.index' , compact(['moderators' , 'sections']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => "required",
            'email'         => "required|email",
            'password'      => "required|min:4" ,
            "section_id"    => "required",
        ]);   

        Moderator::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password) ,
            "section_id"    => $request->section_id, 
        ]);

        return redirect()->route('admin.moderator')->with('success' , "تم اضافة المشرف");
    }


    public function edit($id)
    {
        $moderator = Moderator::find($id);
        if($moderator)
        {
            return response()->json([
                'status' => 200,
                "moderator" => $moderator,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Section Not Found",
            ]);   
        }
    }

    public function update(Request $request , $id)
    {
        $moderator = Moderator::find($id);
        if($moderator)
        {
            $moderator->update([
                'name' => $request->name,
                'email' => $request->email,
                'section_id' => $request->section_id,
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json([
                'status' => 200,
                "message" => "Updated Successfully",
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Moderator Not Found",
            ]);   
        }

    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $moderator = Moderator::findOrFail($id);
        $moderator->delete();
        return redirect()->route('admin.moderator');
    }
    public function fetchSection(){
        $moderators = Moderator::get();
    
        return response()->json([
            'status' => 200,
            "moderators" => $moderators,
        ]);
    }
}
