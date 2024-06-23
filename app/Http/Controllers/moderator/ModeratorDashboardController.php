<?php

namespace App\Http\Controllers\moderator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeratorDashboardController extends Controller
{
    public function index(){
        return view('moderator.dashboard.index');
    }
}
