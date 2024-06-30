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
        $allRate = Rate::where('section_id' , $request->section_id)->get();
        $sum = 0;
        // dd(count($request->rate));
        DB::beginTransaction();
        try {

            for ($i = 0; $i < count($allRate); $i++) {

                StudentRate::create([
                    'section_id' => $request->section_id,
                    'student_id' => $request->student_id,
                    'rate' => $request->rate[$i],
                    'rate_id' => $request->ids[$i],
                ]);
                $sum += $request->rate[$i];
            }
            $total = $sum / count($request->rate);
            // dd($total);

            $Graduated = Graduated::create([
                'section_id' => $request->section_id,
                'student_id' => $request->student_id,
                'rate' => $total,
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
