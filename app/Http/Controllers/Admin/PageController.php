<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Batch;
use App\Model\Department;
use App\Model\CurrentSession;
use App\Model\Programme;
use App\Model\Courses;
use Auth;
class PageController extends Controller
{
    public function home(Request $request){
        $title = "Home";
        $data = array();
        $data['students'] = User::where('role','7')->where('department_id',Auth::guard('my_users')->user()->department_id)->count();
        $data['lecturers'] = User::where('role','6')->where('department_id',Auth::guard('my_users')->user()->department_id)->count();
        $data['courses'] = Courses::where('department_id',Auth::guard('my_users')->user()->department_id)->count();
        return view('admin.home',['title' => $title,'data' => $data]);
    }

    public function departmentReturn(){
        $departments = Department::where('id',Auth::guard('my_users')->user()->department_id)->get();
        return $departments;
    }

    public function courseRegisterPage(Request $request){
        $departments = $this->departmentReturn();
        $programmes = Programme::all();
        $title = "Register Course";
        return view('admin.course_register',['title' => $title,'departments' => $departments, 'programmes' => $programmes]);
    }

    public function studentRegistrationPage(Request $request){
        $departments = $this->departmentReturn();
        $programmes = Programme::all();
        $title = "Student Registration";
        return view('admin.students_register',['title' => $title,'departments' => $departments, 'programmes' => $programmes]);
    }

    public function lecturerRegistrationPage(Request $request){
        $departments = $this->departmentReturn();
        $title = "Lecturer Registration";
        return view('admin.lecturer_register',['title' => $title,'departments' => $departments]);
    }

    public function schedule_page(Request $request){
        $year = date('Y',time());
        $departments = $this->departmentReturn();
        $title = "Session/Semester Schedule";
        return view('admin.session_start',['title' => $title,'departments'=>$departments,'year'=> $year]);
    }

    public function allocationPage(Request $request){
        $title = "Allocate Courses to Lecturers";
        $current = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        $lecturers = User::where('role','6')->where('department_id',Auth::guard('my_users')->user()->department_id)->get();
        $courses = Courses::where('department_id',Auth::guard('my_users')->user()->department_id)->where('semester',$current->semester)->get();
        return view('admin.allocate_lecturers',['title'=>$title,'courses'=>$courses,'lecturers'=>$lecturers]);
    }

    public function resultEditPage(Request $request){
        $title = "Edit Result";
        $sessions_done = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->get();
        $courses = Courses::where('department_id',Auth::guard('my_users')->user()->department_id)->get();
        return view('admin.result_change',['title'=>$title,'sessions'=>$sessions_done,'courses' => $courses]);
    }

    public function transcriptPage(Request $request){
        $title   = 'Transcript';
        return view('admin.transcript',['title' => $title]);
    }

    public function resultUploads(Request $request){
        $title = 'Results Uploaded';
        $uploads = Batch::where('department_id',Auth::guard('my_users')->user()->department_id)->get();
        return view('admin.uploads',['title'=>$title,'uploads'=>$uploads]);
    }

    public function endSessionPage(Request $request){
        $title = "Session Termination";
        $current_session = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        return view('admin.end_session',['title'=>$title,'current_session'=>$current_session]);
    }

    public function pgd_transcriptPage(Request $request){
        $title = "PGD Transcript Page";
        $years = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->get();
        $years = $years->unique('year')->toArray();
        
        return view('admin.pgd_transcript',['title' => $title,'years' => $years]);
    }



}
