<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    public function index()
    {
        $rate = Rate::all();
        return view('admin.rate.index' , compact('rate'));
    }

    public function store (Request $request){
        
        $request->validate([
            'name' => "required",
        ]);
    
        Rate::create([
            "title" => $request->name,
        ]);

        return redirect()->route('admin.rate');
    }

    public function edit($id)
    {
        $rate = Rate::find($id);
        if($rate)
        {
            return response()->json([
                'status' => 200,
                "rate" => $rate,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Rate Not Found",
            ]);   
        }
    }
    public function update(Request $request , $id)
    {
        $rate = Rate::find($id);
        if($rate)
        {
            $rate->update([
                'title' => $request->name,
            ]);
    
            return response()->json([
                'status' => 200,
                "message" => "Updated Successfully",
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                "message" => "Rate Not Found",
            ]);   
        }

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $rate = Rate::findOrFail($id);
        $rate->delete();
        return redirect()->route('admin.rate');
    }

}
