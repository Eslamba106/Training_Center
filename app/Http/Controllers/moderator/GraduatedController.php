<?php

namespace App\Http\Controllers\moderator;

use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraduatedController extends Controller
{
    public function index()
    {
        $moderator= auth()->guard("moderator")->user();
        $grades = Graduated::where('section_id' , $moderator->section_id)->get();

        return view('moderator.graduated.index', compact('moderator','grades'));
    }
}
