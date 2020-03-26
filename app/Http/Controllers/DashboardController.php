<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function loadFilesPage(){
        return view('pages.dashboard.files');
    }

    public function loadDashboardPage(){
        return view('pages.dashboard.dashboard');
    }

    public function loadSharedFilesPage(){
        $sharedfiles = Auth::user()->shared->where('deleted', 0);
        return view('pages.dashboard.shared', compact('sharedfiles'));
    }
}
