<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class SectionStudentController extends Controller
{
    public function index($id)
    {
        $sectionstudents = SectionStudent::where('section_id', $id)->get();
        $student_ids = [];
        foreach ($sectionstudents as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }
        if ($student_ids != null) {
            $students = Student::whereNotIn('id', $student_ids)->get();
        } else {
            $students = Student::get();

        }
        $section = Section::findOrFail($id);

        return view('admin.add_students.index', compact(['students', 'section']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from' => "required",
            'to' => "required",
        ]);
//
        SectionStudent::create([
            'student_id' => $request->student_id_add,
            'section_id' => $request->section_id,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return redirect()->route('admin.section');
    }

    public function show($id)
    {
        $student_ids = [];
        $section = Section::findOrFail($id);
        $section_students = SectionStudent::where('section_id', $section->id)->get();
        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }
        
        if ($student_ids != null) {

            $students = Student::whereIn('id', $student_ids)->get();
        }else{
            $students = [];
            
        }

        return view('admin.add_students.show', compact(['students', 'section', 'section_students']));
    }

}
