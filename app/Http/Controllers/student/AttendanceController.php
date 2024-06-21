<?php

namespace App\Http\Controllers\student;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index($id)
    {
        $student_id = auth()->guard('student')->user()->id;
        $table_attendances = Attendance::where('section_id' , $id)->where('student_id' , $student_id)->get();


        return view('student.attendance.index' , compact('table_attendances'));
    }
}
