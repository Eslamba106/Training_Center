<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Section;
use App\Models\Student;
use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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


                $uni_id = Student::where("id" , $studentid)->first()->university_id;
                // dd($uni_id);
                SectionStudent::create([
                    'student_id'=> $studentid,
                    'section_id'=> $request->section_id,
                    'university_id'=> $uni_id,
                    'from'=> $request->from[$studentid],
                    'to'=> $request->to[$studentid],
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
        $date = Carbon::now();
        // dd($date);
        $student_ids = [];
        $section = Section::findOrFail($id);
        $section_students = SectionStudent::where('section_id', $section->id)->get();
        // dd($section_students);
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

    public function edit($id){
        // $new = Route::current()->parameter('id');
        $previousUrl = URL::previous();

        // Parse the URL and extract the path
        $parsedUrl = parse_url($previousUrl);
        $path = $parsedUrl['path'];

        // Extract the ID from the path (assuming the ID is the last segment)
        $segments = explode('/', rtrim($path, '/'));
        $new_id = end($segments);        // $new = request()->route('id');
        $section = SectionStudent::where('student_id' , $id)->where('section_id' , $new_id)->get();
        if($section)
        {
            return response()->json([
                'status' => 200,
                "section" => $section,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Section Not Found",
            ]);   
        }
    }
    
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $section = SectionStudent::where('section_id' , $request->section_id)->where("student_id" , $request->student_id)->first();
        if($section)
        {
            $section->update([
                'from' => $request->from,
                'to' => $request->to,
            ]);
    
            return response()->json([
                'status' => 200,
                "message" => "Updated Successfully",
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Section Not Found",
            ]);   
        }
        
    }
    public function delete(Request $request)
    {
        $student = SectionStudent::where('student_id', $request->id)->where('section_id' , $request->section_id)->first();
        $student->delete();
        return redirect()->back();
    }

}
