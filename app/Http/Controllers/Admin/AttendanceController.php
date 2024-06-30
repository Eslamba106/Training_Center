<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Section;
use App\Models\Student;
use App\Models\Moderator;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index($id)
    {


        $section = Section::where('id', $id)->first();
        $teachers = Moderator::all();
        // dd($date);
        $date = Carbon::now()->today();
        // $date = Carbon::now()->toDateTime();
        // $currentDate = Carbon::parse($date);
        // dd($date);
        $section_students = SectionStudent::where('section_id', $id)
        ->where('from', '<=', $date)
        ->where('to', '>=', $date)
        ->get();        

        // dd($section_students);
        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }

        if ($student_ids != null) {

            $students = Student::whereIn('id', $student_ids)->get();
        } else {
            $students = [];

        }
        // $students = Student::all();
        return view('admin.attendance.index', compact('section', 'teachers', 'students'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('admin.attendance.index', compact('students'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
                    'moderators_id' => 1,
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
        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }

        if ($student_ids != null) {

            $students = Student::whereIn('id', $student_ids)->get();
        } else {
            $students = [];

        }

        return view('admin.attendance.report', compact('section_students', 'section'));
    }

    public function Search_invoices(Request $request)
    {

        $section = Section::where('id', $request->section_id)->first();
        if ($request->type && $request->start_at == '' && $request->end_at == '') {
            $student_attendance = Attendance::where('section_id', $request->section_id)->get();
            return view('admin.attendance.report', compact('type'))->with('student_attendance', $student_attendance);

        } else {
            if ($request->type == 'all') {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = 'الكل في هذة الفترة';
                $student_attendance = Attendance::where('section_id', $request->section_id)->whereBetween('attendence_date', [$start_at, $end_at])->get();
                return view('admin.attendance.report', compact(['type', 'start_at', 'end_at']))->with('student_attendance', $student_attendance);
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;
                $student_attendance = Attendance::where('section_id', $request->section_id)->whereBetween('attendence_date', [$start_at, $end_at])->get();
                return view('admin.attendance.report', compact(['type', 'start_at', 'end_at', 'section']))->with('student_attendance', $student_attendance);
            }

        }
        // }

        // in case search by invoice number
        return "Eska";
    }

}
