<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function index(){
        $data['subject']=Subject::all();
        return view('pages.exam.index',$data);
    }
}
