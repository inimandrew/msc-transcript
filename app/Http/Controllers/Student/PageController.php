<?php

namespace App\Http\Controllers\Student;
use App\Model\Courses;
use App\Model\CurrentSession;
use App\Model\Results;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function studentHome(Request $request){
        $title = "Home";
        $student_sessions = CurrentSession::where('id',Auth::guard('my_users')->user()->session_of_admission)->first();
        $semester = CurrentSession::where('id','>=',$student_sessions->id)->where('department_id',Auth::guard('my_users')->user()->department_id)->take(Auth::guard('my_users')->user()->programme_id * 2)->count();
        if($semester%2 == '0'){
            $sem = '2';
        }else{
            $sem = '1';
        }

        $year_check = $semester /2;

        if($year_check == 0.5 | $year_check == 1){
            $year = '1';
        }else if($year_check == 1.5 | $year_check == 2){
            $year = '2';
        }else if($year_check == 2.5 | $year_check == 3){
            $year = '3';
        }
        $courses = Courses::where('year',$year)->where('programme_id',Auth::guard('my_users')->user()->programme_id)->where('semester',$sem)->count();
        return view('student.home',['title'=>$title,'courses' => $courses]);
    }

    public function courseRegistrationPage(Request $request){
        $title = "Course Registration";
        $student_sessions = CurrentSession::where('id',Auth::guard('my_users')->user()->session_of_admission)->first();
        $semester = CurrentSession::where('id','>=',$student_sessions->id)->where('department_id',Auth::guard('my_users')->user()->department_id)->take(Auth::guard('my_users')->user()->programme_id * 2)->count();
        if($semester%2 == '0'){
            $sem = '2';
        }else{
            $sem = '1';
        }

        $year_check = $semester /2;

        if($year_check == 0.5 | $year_check == 1){
            $year = '1';
        }else if($year_check == 1.5 | $year_check == 2){
            $year = '2';
        }else if($year_check == 2.5 | $year_check == 3){
            $year = '3';
        }

        $courses = Courses::where('year',$year)->where('programme_id',Auth::guard('my_users')->user()->programme_id)->where('semester',$sem)->get();


        return view('student.registration',['title'=>$title,'courses'=>$courses]);
    }

    public function getResultsPage(Request $request){
        $title = "Results";
        $gpas = array();
        $i = 0;
        $student_sessions = CurrentSession::where('id',Auth::guard('my_users')->user()->session_of_admission)->first();
        $other_session = CurrentSession::where('id','>=',$student_sessions->id)->where('department_id',Auth::guard('my_users')->user()->department_id)->take(Auth::guard('my_users')->user()->programme_id * 2)->get();
        $collection = collect([]);
        foreach($other_session as $sess){
            $results = Auth::guard('my_users')->user()->results()->where('session_id',$sess->id)->get();

            $sem =$this->getSem($sess->semester);
            $show = $sess->year.'/'.($sess->year+1).' '.$sem.' Semester Results';
            $collection->prepend([$show =>$results]);
            $i++;
        }
        

        return view('student.results',['title'=>$title,'sessions_results' => $collection]);
    }

    public function getSem($d){
        if($d == 1){
            $res = "First";
        }else{
            $res = "Second";
        }
        return $res;
    }


    public function getWeight($grade){

        if($grade == 'A'){
            $weight = 5;
        }else if($grade == 'B'){
            $weight = 4;
        }else if($grade == 'C'){
            $weight = 3;
        }else if($grade == 'D'){
            $weight = 2;
        }else if($grade == 'E'){
            $weight = 1;
        }else if($grade == 'F'){
            $weight = 0;
        }
        return $weight;
    }
}
