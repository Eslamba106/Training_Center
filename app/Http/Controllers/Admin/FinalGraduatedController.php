<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Models\FinalGraduated;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class FinalGraduatedController extends Controller
{
    public function index()
    {
        $seniors = FinalGraduated::all();
        $allStudents = SectionStudent::all();
        // very important
        // $sections = Section::get();
        // foreach($sections as $section){
        //     $newquery[] = SectionStudent::where("section_id" , $section->id)->onlyTrashed()->get();
        // }
        
        $student_ids1 = [];
        $student_ids2 = [];
        foreach ($allStudents as $student) {
            $student_ids1[] = $student->student_id;
        }
        foreach ($seniors as $student) {
            $student_ids2[] = $student->student_id;
        }
        $students = Graduated::whereNotIn('student_id', $student_ids1)->whereNotIn('student_id', $student_ids2)->get()->flatten()->unique('student_id');
        
        return view("admin.final_graduated.index", compact(["students", "seniors"]));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // try {

        foreach ($request->graduated as $studentid => $graduated) {
            $section_count =0;
            $final_rate = 0;
            $final_rate = Graduated::where('student_id', $studentid)
                ->selectRaw('SUM(rate) as total')
                ->value('total');
            $section_count = SectionStudent::where('student_id', $studentid)->onlyTrashed()->count();
            FinalGraduated::create([
                'student_id' => $studentid,
                'final_rate' => $final_rate/$section_count,
            ]);

        }

        return redirect()->route('admin.final_graduated')->with('success' , "تم التخرج بنجاح");

        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }
}
