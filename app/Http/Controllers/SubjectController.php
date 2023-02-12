<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function index(){
        return view('pages.admin.subject.index');
    }
    public function addSuject(Request $request){
        // dd($request);
        return $request;
    }
}
