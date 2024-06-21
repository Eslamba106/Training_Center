<?php

namespace App\Http\Controllers\student;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index()
    {

        $id = auth()->guard('student')->user()->id;
        // $section_ids = SectionStudent::where('student_id' , $id)->get() ; 
        $student = Student::where('id' , $id)->first() ; 
        foreach($student->student_section as $section)
        {
            $section_ids[] = $section->section_id;
        }
        foreach($section_ids as $ids){
            $sections[] = Section::where('id' , $ids)->first();
        }
        return view('student.section.index' , compact('sections'));
    }
}
