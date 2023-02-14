<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    //
    public function index()
    {
        $data['subject'] = Subject::all();
        $data['exam'] = Exam::with('subjects')->get();
        return view('pages.exam.index', $data);
    }
    public function addExam(Request $request)
    {
        // _token=rt2PDO9WExXHRU3wqZyon1nSqIxx8VOGyOPtt2oY&name=&subject_id=&date=&time=&status=1
        try {
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'subject_id'=>'required',
                "date"=>'required',
                'time'=>'required',
                'status'=>'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, $validator->errors()]);
            }

            $addExam=Exam::create([
                'exam_name'=>$request->name,
                'subject_id'=>$request->subject_id,
                'date'=>$request->date,
                'time'=>$request->time,
                'status'=>$request->status,
            ]);
            return response()->json(['success' => true, 'msg' => 'Stock Add Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
