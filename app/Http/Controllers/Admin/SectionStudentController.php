<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionStudentController extends Controller
{
    public function index(){
        
        $students = Student::all();
        
        return view('admin.add_student.index' , compact(['students']));
    }
}
