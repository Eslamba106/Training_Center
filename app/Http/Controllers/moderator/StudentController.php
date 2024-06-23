<?php

namespace App\Http\Controllers\moderator;

use App\Models\Section;
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
}
