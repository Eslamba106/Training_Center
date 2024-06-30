<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Section;
use App\Models\Student;
use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
            "university_id"         => $request->university_id, 
            'phone'                 => $request->phone,
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
                'name'                  => $request->name,
                'email'                 => $request->email,
                'password'              => Hash::make($request->password),
                "university_id"         => $request->university_id, 
                'phone'                 => $request->phone,
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
    public function show_excel(Request $request){
        
    }
    public function import_excel(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,xlsx',
        ]);
    
        // $timeToDate = strtotime($row["to"]);
        // // dd($row["from"]);
        // $fromDate = date('Y-m-d',$timeFromDate);
        // $toDate = date('Y-m-d',$timeToDate);
        $excel_section_id = $request->excel_section_id;
        $file_name = $request->file("file");
        Excel::queueImport(new StudentsImport($excel_section_id) , $file_name);
        return redirect()->back()->with("success","Imported");
    }


}
