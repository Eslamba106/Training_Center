<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Graduated;
use App\Models\Rate;
use App\Models\Section;
use App\Models\SectionStudent;
use App\Models\Student;
use App\Models\StudentRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentRateController extends Controller
{
    public function index(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        $student = Student::findOrFail($request->student_id);
        $rates = Rate::where("section_id", $section->id)->get();
        // dd($rates);
        return view('admin.student_rate.index', compact(['rates', 'section', 'student']));
    }

    public function store(Request $request)
    {
        $rate_ids[] = $request->ids;
        $rate[] = $request->rate;
        $allRate = Rate::where("section_id", $request->section_id)->get();
        $sum = 0;
        DB::beginTransaction();
        try {
            $total_degree = 0;
            for ($i = 0; $i < count($allRate); $i++) {
                $rate_degree = Rate::where('id', $request->ids[$i])->first()->degree;
                $total_degree += $rate_degree;
                $final_rate_in_spcific_rate = ($request->rate[$i]) * (1 / 4) * ($rate_degree);
                StudentRate::create([
                    'section_id' => $request->section_id,
                    'student_id' => $request->student_id,
                    'rate' => $final_rate_in_spcific_rate,
                    'rate_id' => $request->ids[$i],
                ]);
                $sum += $final_rate_in_spcific_rate;
            }
            $percentage = ($sum / $total_degree) * 100;
            Graduated::create([
                'section_id' => $request->section_id,
                'student_id' => $request->student_id,
                'rate' => $sum,
                'percentage' => $percentage,
                'graduated_date' => Carbon::now(),
            ]);
            $student = SectionStudent::where('section_id', $request->section_id)->where('student_id', $request->student_id)->first();
            $student->delete();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            throw $e;
        }
        return redirect()->route('admin.section')->with('success', 'تم تخريج الطالب');

    }

    public function rateDetails($id)
    {

    }
}
