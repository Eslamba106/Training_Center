<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rate;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    public function index()
    {
        $rate = Rate::all();
        $sections = Section::all();
        return view('admin.rate.index' , compact(['rate' , 'sections']));
    }

    public function store (Request $request){
        
        $request->validate([
            'name' => "required",
            'section_id' => "required",
        ]);
    
        Rate::create([
            "title" => $request->name,
            "section_id" => $request->section_id,
        ]);

        return redirect()->route('admin.rate');
    }

    public function edit($id)
    {
        $rate = Rate::find($id);
        // $section = Rate::find($id);
        if($rate)
        {
            return response()->json([
                'status' => 200,
                "rate" => $rate,
                
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "danger" => "Rate Not Found",
            ]);   
        }
    }
    public function update(Request $request , $id)
    {
        $rate = Rate::find($id);
        // dd($request->all());
        if($rate)
        {
            $rate->update([
                'title' => $request->name,
                'section_id' => $request->section_id,
            ]);
    
            return response()->json([
                'status' => 200,
                "success" => "Updated Successfully",
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "danger" => "Rate Not Found",
            ]);   
        }

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $rate = Rate::findOrFail($id);
        $rate->delete();
        return redirect()->route('admin.rate');
    }

}
