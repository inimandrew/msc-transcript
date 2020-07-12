<?php

namespace App\Http\Controllers\Lecturer;
use App\Http\Controllers\Admin\LoadController as AdminFunction;
use Auth;
use Excel;
use Validator;
use Session;
use App\Imports\ExportData;
use App\Imports\Result;
use App\Model\CurrentSession;
use App\Model\Courses;
use App\Model\Results;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\HeadingRowImport;


class LoadController extends Controller
{   private $user;

    public function __construct(AdminFunction $user){
        $this->user = $user;
    }
    public function getList(Request $request){
        $current = isset($request['session_id']) ? CurrentSession::where('id',$request['session_id'])->where('running','1')->first() : CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        $exportclass = new ExportData($request['course_id'],$current->id);
        $course = Courses::find($request['course_id']);
        return Excel::download($exportclass , $course->title.'('.$course->code.') Registration List.xlsx');
    }

    public function uploadDataVerification(Request $request){
        return Validator::make($request->except('_token'),[
            'data_file' => 'required|file',
        ]);
    }

    public function uploadResult(Request $request){
        $validation = $this->uploadDataVerification($request);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation->getMessageBag());
            }else if($request->hasFile('data_file')){
                $headings = (new HeadingRowImport)->toArray($request['data_file']);
                $requiredHeadings = array('matriculation_number','assessment_score','examination_score');
                $headings_check = $this->user->validateHeadings($requiredHeadings,$headings[0][0]);

                if(count($headings_check) > 0){
                    Session::put('red',1);
                    return redirect()->back()->withErrors($headings_check);
                }
                $data = new Result($request['course_id'],$request['session_id']);
                Excel::import($data, $request->file('data_file'));

                if($data->validation_error == '1'){
                    Session::put('red',1);
                return redirect()->back()->withErrors($data->messages);
                }else{

                Session::put('yellow',1);

                return redirect()->back()->withErrors($data->messages);
                }


            }
    }

    public function getResultsPage(Request $request,$session_id,$course_id){
        $results = Results::where('course_id',$course_id)->where('session_id',$session_id)->get();
        $course = Courses::find($course_id);
        $current_sess = CurrentSession::find($session_id);
        $title = "Results";
        return view('lecturer.result_show',['title' => $title,'course'=>$course,'session' => $current_sess,'results' =>$results]);
    }

}
