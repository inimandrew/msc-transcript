<?php

namespace App\Http\Controllers\Lecturer;
use App\Model\User;
use Auth;
use App\Model\CurrentSession;
use App\Model\LecturerCourses;
use App\Model\Courses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function current_session(){
        $current = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        return $current;
    }
    public function lecturerHome(Request $request){
        $title = "Home";
        $current = $this->current_session();

        if(!$current){
            return redirect()->route('lecture_history');
        }else{
        $lecturer_allocated = User::whereHas('courses', function($query) use ($current){
            $query->where('session_id',$current->id)->where('lecturer_id',Auth::guard('my_users')->user()->id);
        })->count();

        return view('lecturer.home',['title'=>$title,'allocated_courses'=>$lecturer_allocated]);}
    }

    public function allocatedPage(Request $request){
        $title = "Allocated Courses";
        $current = $this->current_session();
        $courses_allocated =  Courses::whereHas('lecturers', function($query) use ($current){
            $query->where('lecturer_id',Auth::guard('my_users')->user()->id)->where('session_id',$current->id);
        })->get();
        return view('lecturer.allocated',['title'=>$title,'courses'=>$courses_allocated]);
    }

    public function courseHistory(Request $request){
        $title = "Courses History";
        $current = $this->current_session();
        $courses_taught = LecturerCourses::where('lecturer_id',Auth::guard('my_users')->user()->id)->get();

        return view('lecturer.history',['title'=>$title,'courses'=>$courses_taught]);
    }

    public function resultPage(Request $request,$session_id,$course_id){
        $title = "Result Page";
        $session_taught = CurrentSession::find($session_id);
        $course = Courses::find($course_id);
        return view('lecturer.result',['title' => $title,'session'=>$session_taught,'course' =>$course]);
    }
}
