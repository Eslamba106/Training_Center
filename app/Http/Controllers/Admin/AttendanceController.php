<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Section;
use App\Models\Student;
use App\Models\Moderator;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index($id)
    {

        // $date = Carbon\Carbon::now()->today();
        // $final_date = date("Y-m-d" ,strtotime($student_section->to)) ;
        // $today_date = date("Y-m-d" ,strtotime($date));

        $section = Section::where('id', $id)->first();
        $teachers = Moderator::all();
        $date = Carbon::now()->today();
        // $section_students = SectionStudent::where('section_id', $moderator->section_id)->withTrashed()->get();
        $section_students = SectionStudent::where('section_id', $id)
            ->where('from', '<=', $date)
            ->where('to', '>=', $date)
            ->get();

        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }

        if ($student_ids != null) {

            $students = Student::whereIn('id', $student_ids)->get();
        } else {
            $students = [];

        }
        return view('admin.attendance.index', compact('section', 'teachers', 'students'));
    }
    public function dayNumber(Request $request)
    {
        if($request->day == 1){
            $day = Carbon::yesterday()->toDateString(); 
            $students = Attendance::where('section_id', $request->section_id)
            ->whereDate('attendence_date', $day)
            ->get();
            $section_students = SectionStudent::where('section_id', $request->section_id)
            ->where('from', '<=', $day)
            ->where('to', '>=', $day)
            ->withTrashed()
            ->get();
        }
        else if ($request->day == 2){
            $day = Carbon::now()->subDays(2)->toDateString();
            $students = Attendance::where('section_id', $request->section_id)
            ->whereDate('attendence_date', $day)
            ->get();
            $section_students = SectionStudent::where('section_id', $request->section_id)
            ->where('from', '<=', $day)
            ->where('to', '>=', $day)
            ->withTrashed()
            ->get();        
        }
        else if ($request->day == 3)
        {
            $day = Carbon::now()->subDays(3)->toDateString();
            $students = Attendance::where('section_id', $request->section_id)
            ->whereDate('attendence_date', $day)
            ->get();
            $section_students = SectionStudent::where('section_id', $request->section_id)
            ->where('from', '<=', $day)
            ->where('to', '>=', $day)
            ->withTrashed()
            ->get();

        }
                
    }
    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('admin.attendance.index', compact('students'));
    }

    public function store(Request $request)
    {
        $moderator = Moderator::where('section_id', $request->section_id)->first();
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::create([
                    'student_id' => $studentid,
                    'section_id' => $request->section_id,
                    'moderators_id' => $moderator->id ?? 1,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status,
                    'excused' => $request->excused[$studentid] ?? null,
                ]);

            }

            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function print($id)
    {

        $attendence_tables = Attendance::where('section_id', $id)->where('attendence_date', date('Y-m-d'))->get();
        $section = Section::where('id', $id)->first();
        $attendence_tables->toArray();

        foreach ($attendence_tables as $attendence_table) {
            $students[] = Student::where('id', $attendence_table->student_id)->first();
        }
        return view('admin.print.attendance_table', compact(['attendence_tables', 'students', 'section']));
    }

    public function report($id)
    {
        $section = Section::where('id', $id)->first();
        $section_students = SectionStudent::where('section_id', $section->id)->get();
        foreach ($section_students as $section_student) {
            $allstudents[] = Student::where('id', $section_student->student_id)->first();
        }
        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }

        if ($student_ids != null) {

            $students = Student::whereIn('id', $student_ids)->get();
        } else {
            $students = [];

        }

        return view('admin.attendance.report', compact(['section_students', 'section', 'students', 'allstudents']));
    }

    public function Search_invoices(Request $request)
    {
        $section = Section::where('id', $request->section_id)->first();
        $section_students = SectionStudent::where('section_id', $section->id)->get();
        foreach ($section_students as $section_student) {
            $allstudents[] = Student::where('id', $section_student->student_id)->first();
        }
        if ($request->student_id == null) {

            if ($request->start_at == '' && $request->end_at == '') {
                $student_attendance = Attendance::where('section_id', $request->section_id)->get();
                return view('admin.attendance.report', compact('allstudents' , 'section'))->with('student_attendance', $student_attendance);

            } else {
                if ($request->type == 'all') {
                    $start_at = date($request->start_at);
                    $end_at = date($request->end_at);
                    $type = 'الكل في هذة الفترة';
                    $student_attendance = Attendance::where('section_id', $request->section_id)->whereBetween('attendence_date', [$start_at, $end_at])->get();
                    return view('admin.attendance.report', compact(['type', 'start_at', 'end_at', 'allstudents' ,'section']))->with('student_attendance', $student_attendance);
                } else {
                    $start_at = date($request->start_at);
                    $end_at = date($request->end_at);
                    $type = $request->type;
                    $student_attendance = Attendance::where('section_id', $request->section_id)->whereBetween('attendence_date', [$start_at, $end_at])->get();
                    return view('admin.attendance.report', compact(['type', 'start_at', 'end_at', 'section', 'allstudents']))->with('student_attendance', $student_attendance);
                }

            }
        } elseif(isset($request->student_id)){
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $type = $request->type;
            if($request->start_at == '' && $request->end_at == ''){
                
                $student_attendance = Attendance::where('section_id', $request->section_id)->where('student_id', $request->student_id)->get();
            }
            else{
                
                $student_attendance = Attendance::where('section_id', $request->section_id)->where('student_id', $request->student_id)->whereBetween("attendence_date", [$start_at, $end_at])->get();
            }
            return view('admin.attendance.report', compact('allstudents', 'section'))->with('student_attendance', $student_attendance);
        }
    }

}
