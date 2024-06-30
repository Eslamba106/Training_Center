<?php

namespace App\Http\Controllers\moderator;

use App\Models\Rate;
use App\Models\Section;
use App\Models\Student;
use App\Models\Graduated;
use App\Models\StudentRate;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {

        $moderator = auth()->guard('moderator')->user();
        $section = Section::where('id', $moderator->section_id)->first();
        $students = SectionStudent::where('section_id', $section->id)->where('deleted_at' , null)->get();
        return view('moderator.students.index', compact('students'));
    }

    public function show($id)
    {
        $moderator          = auth()->guard('moderator')->user();
        $student            = Student::findOrFail($id);
        $section            = Section::where('id', $moderator->section_id)->first();
        $section_students   = SectionStudent::where('section_id', $section->id)->where('student_id' , $id)->onlyTrashed()->first();
        $student_rates      = StudentRate::where('section_id', $section->id)->where('student_id' , $id)->get();
        $finalRate          = Graduated::where('section_id', $section->id)->where('student_id' ,$id)->first();
        $title_rate = [];         //= Rate::where('section_id', $section->id)->get();
        $rates = [];
        foreach ($student_rates as $student_rate) {
            $rates[$student_rate->rate_id] = $student_rate->rate;
        }
        $allRates =[];
        foreach ($rates as $key => $value) {
            $title_rate = Rate::where('id' , $key)->first();
            $allRates[$title_rate->title] = $value ;
        }
        return view('moderator.students.show', compact(['student' , 'section' , 'section_students' , 'allRates' , 'finalRate']));
    }
}
