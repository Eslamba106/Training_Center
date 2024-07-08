<?php

namespace App\Http\Controllers\moderator;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\Student;
use App\Models\Graduated;
use App\Models\StudentRate;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudentRateController extends Controller
{
    public function index($id)
    {
        $student = Student::findOrFail($id);
        $section = auth()->guard("moderator")->user()->section;
        $rates = Rate::where("section_id", $section->id)->get();
        return view("moderator.student_rate.index", compact("student", "section", "rates"));
    }

    public function store(Request $request)
    {
        $rate_ids[] = $request->ids;
        $rate[] = $request->rate;
        $allRate = Rate::where('section_id', $request->section_id)->get();
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
            $Graduated = Graduated::create([
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
        return redirect()->route('moderator.students')->with('success', 'تم تخريج الطالب');

    }

}
