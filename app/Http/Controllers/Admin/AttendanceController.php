<?php

namespace App\Http\Controllers\Admin;

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
        // $Grades = Grade::with(['Sections'])->get();
        $section = Section::where('id' , $id)->first();
        $teachers = Moderator::all();

        $section_students = SectionStudent::where('section_id', $section->id)->get();
        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }
        
        if ($student_ids != null) {

            $students = Student::whereIn('id', $student_ids)->get();
        }else{
            $students = [];
            
        }
        // $students = Student::all();
        return view('admin.attendance.index',compact('section','teachers' , 'students'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.Attendance.index',compact('students'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if( $attendence == 'presence' ) {
                    $attendence_status = true;
                } else if( $attendence == 'absent' ){
                    $attendence_status = false;
                }
                // if( $attendence == 'presence' ) {
                //     $attendence_status = true;
                // } else if( $attendence == 'absent' ){
                //     $attendence_status = false;
                // }


                Attendance::create([
                    'student_id'=> $studentid,
                    'section_id'=> $request->section_id,
                    'moderators_id'=> 1,
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_status,
                    'excused'=> $request->excused[$studentid] ?? null
                ]);

            }


            return redirect()->back();

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function print($id){

        
        $attendence_tables = Attendance::where('section_id' , $id)->where('attendence_date', date('Y-m-d'))->get();
        $section = Section::where('id' , $id)->first();
        $attendence_tables->toArray();

        foreach ($attendence_tables as $attendence_table){
            $students[] = Student::where('id' , $attendence_table->student_id)->first();
        }
                // dd($attendence_tables);
        return view('admin.print.attendance_table' , compact(['attendence_tables' , 'students' , 'section']));
    }

    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}
