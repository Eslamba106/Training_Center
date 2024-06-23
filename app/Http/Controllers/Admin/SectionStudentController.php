<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Student;
use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class SectionStudentController extends Controller
{
    public function index($id)
    {
        $sectionstudents1 = SectionStudent::where('section_id', $id)->get();
        $sectionstudents2 = Graduated::where('section_id', $id)->get();
        $student_ids1 = [];
        $student_ids2 = [];
        // dd($sectionstudents1);
        foreach ($sectionstudents1 as $sectionstudent) {
            $student_ids1[] = $sectionstudent->student_id;
        }
        foreach ($sectionstudents2 as $sectionstudent) {
            $student_ids2[] = $sectionstudent->student_id;
        }
        // dd($student_ids2);   
        if ($student_ids1 != null || $student_ids2 != null) {
            $students = Student::whereNotIn('id', $student_ids1)->whereNotIn('id' , $student_ids2)->get();
        } else {
            $students = Student::get();

        }
        $section = Section::findOrFail($id);

        return view('admin.add_students.index', compact(['students', 'section']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'from' => "required",
            'to' => "required",
        ]);
        try {

            foreach ($request->status as $studentid => $attendence) {
                // $request->validate([
                //     "from[$studentid]" => "required",
                //     "to[$studentid]" => "required",
                // ]);
                if( $attendence == 'presence' ) {
                    $attendence_status = true;
                } 
                else if( $attendence == 'absent' ){
                    $attendence_status = false;
                }



                SectionStudent::create([
                    'student_id'=> $studentid,
                    'section_id'=> $request->section_id,
                    'from'=> $request->from[$studentid],
                    'to'=> $request->to[$studentid],
                    // 'attendence_status'=> $attendence_status,
                    // 'excused'=> $request->excused[$studentid] ?? null
                ]);

            }


            return redirect()->back();

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        // SectionStudent::create([
        //     'student_id' => $request->student_id_add,
        //     'section_id' => $request->section_id,
        //     'from' => $request->from,
        //     'to' => $request->to,
        // ]);
        // return redirect()->route('admin.section');
    }

    public function show($id)
    {
        $student_ids = [];
        $section = Section::findOrFail($id);
        $section_students = SectionStudent::where('section_id', $section->id)->get();
        foreach ($section_students as $sectionstudent) {
            $student_ids[] = $sectionstudent->student_id;
        }
        
        if ($student_ids != null) {

            $students = Student::whereIn('id', $student_ids)->get();
        }else{
            $students = [];
            
        }

        return view('admin.add_students.show', compact(['students', 'section', 'section_students']));
    }

}
