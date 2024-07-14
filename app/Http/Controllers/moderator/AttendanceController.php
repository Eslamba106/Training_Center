<?php

namespace App\Http\Controllers\moderator;

use App\Models\Section;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        $moderator = auth()->guard('moderator')->user();
        $section = auth()->guard('moderator')->user()->section;
        $allstudents = Attendance::where('section_id' , $moderator->section_id)->get();
        $section_students = SectionStudent::where('section_id', $moderator->section_id)
        // ->withTrashed()
        ->get();
        $student_ids = [];
        $students = [];
        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }
        if (!empty($student_ids)) {

            $students = Student::whereIn('id', $student_ids)->get();
        }
        return view('moderator.attendance.index' , compact('students' , 'section'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $moderator = auth()->guard('moderator')->user();
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
                    'moderators_id' => $moderator->id,
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

    public function print()
    {
        $moderator = auth()->guard('moderator')->user();
        
        $attendence_tables = Attendance::where('section_id', $moderator->section_id)->where('attendence_date', date('Y-m-d'))->get();
        $section = Section::where('id', $moderator->section->id )->first();
        $attendence_tables->toArray();

        foreach ($attendence_tables as $attendence_table) {
            $students[] = Student::where('id', $attendence_table->student_id)->first();
        }
        return view('moderator.print.attendance_table', compact(['attendence_tables', 'students', 'section']));
    }
}
