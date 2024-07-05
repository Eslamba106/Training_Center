<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Graduated;
use Illuminate\Http\Request;
use App\Models\SectionStudent;
use App\Http\Controllers\Controller;

class GraduatedController extends Controller
{
    public function index($id)
    {
        $graduates = Graduated::where('section_id' , $id)->get();
        $section = Section::where('id' , $id)->first();
        $section_students = SectionStudent::where('section_id', $id)->get();
        return view("admin.graduated.index" , compact(["graduates" , 'section' , 'section_students']));
    }
    public function search_graduation(Request $request)
    {
        $section = Section::where('id', $request->section_id)->first();
        if ($request->type && $request->start_at == '' && $request->end_at == '') {
            $graduates = Graduated::where('section_id', $request->section_id)->get();
            // return "Eslam";
            return view('admin.graduated.index' ,compact('type' , 'section'))->with('graduates', $graduates);

        } else {
            if ($request->type == 'all' || $request->start_at == '' && $request->end_at == '') {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = 'الكل في هذة الفترة';
                $graduates = Graduated::where('section_id', $request->section_id)->get();

                return view('admin.graduated.index', compact(['type', 'start_at', 'end_at' ,'section']))->with('graduates', $graduates);
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;
                $graduates = Graduated::where('section_id', $request->section_id)->whereBetween('graduated_date', [$start_at, $end_at])->get();
                return view('admin.graduated.index', compact(['type', 'start_at', 'end_at', 'section']))->with('graduates', $graduates);
            }

        }
        // }

        // in case search by invoice number
    }

}
