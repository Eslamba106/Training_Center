<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentRate;
use Illuminate\Http\Request;

class StudentRateController extends Controller
{
    public function index(Request $request ,$id)
    {
        $section = Section::findOrFail($id);
        $student = Student::findOrFail($request->student_id);
        $rates = Rate::get();
        return view('admin.student_rate.index' , compact(['rates' , 'section' , 'student']));
    }

    public function store(Request $request)
    {
        $rate_ids[] = $request->ids ;
        $rate[] = $request->rate ;
        $allRate = Rate::all();
        for($i=0 ; $i < count($allRate) ; $i++){
            StudentRate::create([
                'section_id' => $request->section_id,
                'student_id' => $request->student_id,
                'rate' => $request->rate[$i] ,
                'rate_id' => $request->ids[$i],
            ]);
        }
        return redirect()->route('admin.section');

    }
}
