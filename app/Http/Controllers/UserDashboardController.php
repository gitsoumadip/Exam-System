<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //
    function admindashboard()
    {
        return view('pages.admin.adminDashboard.dashboard');
    }
    function studentdashboard()
    {
        return view('pages.student.studentDashboard.student');
    }
}
