<?php

namespace App\Http\Controllers\Student;
use Validator;
use Auth;
use Session;
use App\Model\Courses;
use App\Model\User;
use App\Model\CurrentSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoadController extends Controller
{
    public $messages;

    public function validateData(Request $request){
        return Validator::make($request->except('_token'),[
            'courses.*' => 'required|exists:courses,id',
        ]);
    }

    public function courseRegistrationAction(Request $request){
        $validation = $this->validateData($request);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->getMessageBag());
        }else if($this->validation2($request)){
            Session::put('red',1);
            return redirect()->back()->withErrors($this->messages);
        }else{
            $user = Auth::guard('my_users')->user();
            $current = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
            foreach($request['courses'] as $course){
                $course_to_register = Courses::find($course);
                $user->courses1()->save($course_to_register,['session_id'=>$current->id]);
            }
            Session::put('green',1);
            return redirect()->back()->withErrors("Your registration is completed successfully");
        }
    }

    public function validation2(Request $request){
        $error = array();
        $current = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        foreach($request['courses'] as $course){
            $check = User::whereHas('courses1', function($query) use ($current,$course){
                $query->where('session_id',$current->id)->where('course_id',$course)->where('student_id',Auth::guard('my_users')->user()->id);
            })->count();
            $course_to_see = Courses::find($course);
            if($check == '1'){
                $error[] = $course_to_see->title."(".$course_to_see->code.") has already been registered";
            }
        }
        $this->messages = $error;
        if(count($error) > 0){
            return true;
        }else{
            return false;
        }
    }


}
