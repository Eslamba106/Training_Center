<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Student;
use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::get();
        $moderators = Moderator::get();
        $sections = Section::get();
        return view('admin.students.index' , compact(['students' ,'moderators' , 'sections']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => "required",
            'email'         => "required|email",
            'password'      => "required|min:4" ,
            // "section_id"    => "required",
        ]);   

        Student::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => Hash::make($request->password) ,
            // "student_section_id"    => $request->section_id, 
            // 'from'                  => $request->from,
            // 'to'                    => $request->to,
        ]);

        return redirect()->route('admin.student');
    }


    public function edit($id)
    {
        $student = Student::find($id);
        if($student)
        {
            return response()->json([
                'status' => 200,
                "student" => $student,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Student Not Found",
            ]);   
        }
    }

    public function update(Request $request , $id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'student_section_id' => $request->section_id,
                // 'from' => $request->from,
                // 'to' => $request->to,
            ]);
    
            return response()->json([
                'status' => 200,
                "message" => "Updated Successfully",
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Student Not Found",
            ]);   
        }

    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('admin.student');
    }
    public function fetchSection(){
        $students = Student::get();
    
        return response()->json([
            'status' => 200,
            "students" => $students,
        ]);
    }

}
