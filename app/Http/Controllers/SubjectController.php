<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    public function index()
    {
        // $data['SubjectController'] = 'subject';
        $data['subject']=Subject::all();
        return view('pages.admin.subject.index',$data);
    }
    public function addSuject(Request $request)
    {
        // dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, $validator->errors()]);
            }
            $AddSubject = Subject::create([
                'subject' => $request->name
            ]);
            return response()->json(['success' => true, 'msg' => 'Stock Add Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
