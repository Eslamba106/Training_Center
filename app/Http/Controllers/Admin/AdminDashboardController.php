<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Section;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\FinalGraduated;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index(){
        $sections   = Section::count();
        $student_section = SectionStudent::count();
        $seniors = FinalGraduated::count();
        // $attendance = Attendance::where('section_id', $section->id)->where('attendence_date' , Carbon::now()->toDateString())->where('attendence_status' , 1)->get();
        // $excused = Attendance::where('section_id', $section->id)->where('attendence_date' , Carbon::now()->toDateString())->where('attendence_status' , 0)->get();
        // $currentDay = Carbon::now()->toDateString();
        return view('admin.dashboard.index',compact(['sections' , 'seniors' , 'student_section']));
    }
}
