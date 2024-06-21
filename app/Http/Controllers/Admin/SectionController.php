<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::get();
        return view('admin.section.index' , compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"   => "required",
        ]);

        Section::create([
            'name'   => $request->name,
        ]);
        return back()->with('success' , 'تم اضافة القسم!');

    }

    public function edit($id)
    {
        $section = Section::find($id);
        if($section)
        {
            return response()->json([
                'status' => 200,
                "section" => $section,
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
        $section = Section::find($id);
        if($section)
        {
            $section->update([
                'name' => $request->name,
            ]);
    
            return response()->json([
                'status' => 200,
                "message" => "Updated Successfully",
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Section Not Found",
            ]);   
        }

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('admin.section');
    }

    public function fetchSection(){
        $sections = Section::get();
    
        return response()->json([
            'status' => 200,
            "sections" => $sections,
        ]);
    }
}
