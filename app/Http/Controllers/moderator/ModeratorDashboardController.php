<?php

namespace App\Http\Controllers\moderator;

use Carbon\Carbon;
use App\Models\Section;
use App\Models\Graduated;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class ModeratorDashboardController extends Controller
{
    public function index(){
        $moderator = auth()->guard('moderator')->user();
        $section   = Section::where('id', $moderator->section_id)->first();
        $student_section = SectionStudent::where('section_id', $section->id)->get();
        $seniors = Graduated::where('section_id', $section->id)->get();
        $attendance = Attendance::where('section_id', $section->id)->where('attendence_date' , Carbon::now()->toDateString())->where('attendence_status' , 1)->get();
        $excused = Attendance::where('section_id', $section->id)->where('attendence_date' , Carbon::now()->toDateString())->where('attendence_status' , 0)->get();
        $currentDay = Carbon::now()->toDateString();

        // dd(count($attendance));
        return view('moderator.dashboard.index' , compact(['section' , 'seniors' , 'student_section' , 'attendance' , 'excused']));
    }
}
