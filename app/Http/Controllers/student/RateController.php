<?php

namespace App\Http\Controllers\student;

use App\Models\StudentRate;
use Illuminate\Http\Request;
use App\Models\FinalGraduated;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    public function index()
    {
        $student = auth()->guard('student')->user();
        $allrates   = StudentRate::where('student_id' , $student->id)->get();
        return view('student.rates.index', compact('allrates'));
    }
    public function final()
    {
        $student = auth()->guard('student')->user();
        $senior  = FinalGraduated::where('student_id', $student->id)->first();
        return view('student.rates.finalRates', compact('senior'))->with('success', "مبروك تم التخرج بتقييم {$senior->final_rate}");
    }
}
