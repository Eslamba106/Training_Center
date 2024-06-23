<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class GraduatedController extends Controller
{
    public function index($id)
    {
        $graduates = Graduated::where('section_id' , $id)->get();
        $section = Section::where('id' , $id)->first();
        $section_students = SectionStudent::where('section_id', $id)->get();
        return view("admin.graduated.index" , compact(["graduates" , 'section' , 'section_students']));
    }
}
