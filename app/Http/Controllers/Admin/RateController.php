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
        return view('admin.rate.index', compact(['rate', 'sections']));
    }

    public function store(Request $request)
    {
        if (isset($request->section_id)) {
            $request->validate([
                'name' => "required",
                'degree' => "required",
            ]);

            Rate::create([
                "title" => $request->name,
                "section_id" => $request->section_id,
                "degree" => $request->degree,
            ]);

            return redirect()->route('admin.rate')->with('success', 'تم اضافة التقييم بنجاح !');
        } else 
        {
            $sections = Section::all();
            foreach ($sections as $section) {
                Rate::create([
                    "title" => $request->name,
                    "section_id" => $section->id,
                    "degree" => $request->degree,
                ]);
            }
            return redirect()->route('admin.rate')->with('success', 'تم اضافة التقييم بنجاح !');

        }
    }

    public function edit($id)
    {
        $rate = Rate::find($id);
        // $section = Rate::find($id);
        if ($rate) {
            return response()->json([
                'status' => 200,
                "rate" => $rate,

            ]);
        } else {
            return response()->json([
                'status' => 404,
                "danger" => "Rate Not Found",
            ]);
        }
    }
    public function update(Request $request, $id)
    {
        $rate = Rate::findOrFail($id);
        $rates = Rate::all();
        if (isset($request->section_id)) {
            $rate->update([
                'title' => $request->name,
                'section_id' => $request->section_id,
                'degree' => $request->degree,
            ]);

            return response()->json([
                'status' => 200,
                "success" => "Updated Successfully",
            ]);
        }  else 
        {
            $sections = Section::all();
            foreach ($sections as $section) {
                Rate::create([
                    "title" => $request->name,
                    "section_id" => $section->id,
                    "degree" => $request->degree,
                ]);
            }
            $rate->delete();

            return response()->json([
                'status' => 200,
                "success" => "Updated Successfully",
            ]);        }

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $rate = Rate::findOrFail($id);
        $rate->delete();
        return redirect()->route('admin.rate');
    }
    public function section_rate($id)
    {
        $section = Section::findOrFail($id);
        $rates = Rate::where('section_id', $id)->get();
        return view('admin.rate.section_rate', compact(['rates', 'section']))->with('danger' , 'تم الحذف بنجاح');
    }

}
