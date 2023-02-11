<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    function dashboard(){
        return view('pages.user.dashboard.dashboard');
    }
}
