<?php

namespace App\Http\Controllers\Admin;
use App\Model\Courses;
use App\Model\User;
use App\Model\CurrentSession;
use App\Model\Results;
use Session;
use Validator;
use Excel;
use Auth;
use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Imports\LecturerImport;
use Maatwebsite\Excel\HeadingRowImport;
use App\Http\Controllers\Controller;
use PDF;
use App\Imports\DownloadFormat;
use App\Imports\AdmissionFormat;

class LoadController extends Controller
{

    public function validateCourseData(Request $request){
        return Validator::make($request->except('_token'),[
            'course_title' => 'required|unique:courses,title',
            'course_code' => 'required|unique:courses,code',
            'credit_hour' => 'required|min:1|max:20|integer',
            'department_id' => 'required|integer|exists:departments,id',
            'programme_id' => 'required|integer|exists:programmes,id',
            'year' => 'required|integer|min:1|max:3',
            'semester' => 'required|integer|min:1|max:2'
        ]);
    }

    public function registerCourse(Request $request){
        try{
        $validation = $this->validateCourseData($request);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
        }else{
            $course = new Courses;
            $course->title = ucwords(strtolower($request['course_title']));
            $course->code = strtoupper(strtolower($request['course_code']));
            $course->credit_hour = strtoupper(strtolower($request['credit_hour']));
            $course->department_id = $request['department_id'];
            $course->programme_id = $request['programme_id'];
            $course->year = $request['year'];
            $course->semester = $request['semester'];
            $course->save();
            Session::put('green',1);
            return redirect()->back()->withErrors('Course Registration is successful');
        }
        }catch(\Exception $e){
            Session::put('red',1);
            return redirect()->back()->withErrors('An Error occured, Try Again later or contact support');
        }
    }

    public function validateStudentsData(Request $request){
        return Validator::make($request->except('_token'),[
            'data_file' => 'required|file',
            'department_id' => 'required|integer|exists:departments,id',
            'programme_id' => 'required|integer|exists:programmes,id'
        ]);
    }



    public function registerStudent(Request $request){

        $validation = $this->validateStudentsData($request);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
            }else{

        if($request->hasFile('data_file')){
                $headings = (new HeadingRowImport)->toArray($request['data_file']);
                $requiredHeadings = array('firstname','lastname','middlename','email','matriculation_number');
                $headings_check = $this->validateHeadings($requiredHeadings,$headings[0][0],'student',$request['programme_id']);

                if(count($headings_check) > 0){
                    Session::put('red',1);
                    return redirect()->back()->withErrors($headings_check);
                }
                $data = new UserImport($request['department_id'],$request['programme_id']);
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
    }

    public function validateStudentsFile(Request $request){
        return Validator::make($request->except('_token'),[
            'data_file' => 'required|file',
            'department_id' => 'required|integer|exists:departments,id',
            'programme_id' => 'required|integer|exists:programmes,id'
        ]);
    }

    public function registerStudents(Request $request){
        $validation = $this->validateStudentsFile($request);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
            }else{
                if($request->hasFile('data_file')){
                    $headings = (new HeadingRowImport)->toArray($request['data_file']);
                    $requiredHeadings = ["candidate_full_name", "status", "qualification","university", "year_of_graduation", "class_of_degree", "degree_in_view",
                     "referee_report_received", "transcript_received_gpa", "concept_note", "written_score", "oral_score", "departmental_graduate_committee_recommendation"
                    , "faculty_graduate_committee_recommendation", "graduate_school_recommendation"];
                    $headings_check = $this->validateHeadings($requiredHeadings,$headings[0][0],'student');

                    if(count($headings_check) > 0){
                        Session::put('red',1);
                        return redirect()->back()->withErrors($headings_check);
                    }

                    $data = new AdmissionFormat($request['programme_id']);
                    Excel::import($data, $request->file('data_file'));

                    if($data->validation_error == 1){
                        Session::put('red',1);
                    return redirect()->back()->withErrors($data->messages);

                    }else if($data->validation_error == 2){
                        Session::put('red',1);
                        return redirect()->back()->withErrors($data->messages);
                    }else{
                    Session::put('green',1);
                    return redirect()->back()->withErrors($data->messages);
                    }

            }
            }
    }

    public function validateHeadings($required,$headings){
        $error = array();
            for($i = 0; $i < count($required); $i++){
                $value = $required[$i];

                if(!in_array($value,$headings)){
                    $error[$value] = $value." column not found";
                }
            }

            return $error;

    }



    public function validateLecturerData(Request $request){
        return Validator::make($request->except('_token'),[
            'data_file' => 'required|file',
            'department_id' => 'required|integer|exists:departments,id'
        ]);
    }

    public function registerLecturer(Request $request){

        $validation = $this->validateLecturerData($request);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
            }else{

        if($request->hasFile('data_file')){
            $headings = (new HeadingRowImport)->toArray($request['data_file']);
            $requiredHeadings = array('firstname','lastname','middlename','email','staff_id','rank','specialty');
            $headings_check = $this->validateHeadings($requiredHeadings,$headings[0][0],'lecturer');

            if(count($headings_check) > 0){
                    Session::put('red',1);
                    return redirect()->back()->withErrors($headings_check);
                }

                $data = new LecturerImport($request['department_id']);
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
    }

    public function validateSessionData(Request $request){
        return Validator::make($request->except('_token'),[
            'year'=>'required|integer',
            'semester' => 'required|integer|min:1|max:2',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'department' => 'required|integer|exists:departments,id'
        ]);
    }

    public function scheduleAction(Request $request){
        $validation = $this->validateSessionData($request);

        if($validation->fails()){
            dd($validation->getMessageBag());
            return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
        }else{
            $new_session = new CurrentSession;
            $new_session->year = $request['year'];
            $new_session->semester = $request['semester'];
            $new_session->start_on = $request['date_start'];
            $new_session->end_on = $request['date_end'];
            $new_session->department_id = Auth::guard('my_users')->user()->department_id;
            $new_session->running = '1';
            $new_session->save();
            Session::put('green',1);
            return redirect()->route('admin_home')->withErrors('A new session/semester has been scheduled');
        }
    }

    public function validateLecturers(Request $request){
        return Validator::make($request->except('_token'),[
            'course' => 'required|integer|exists:courses,id',
            'lecturers.*' => 'required|integer|exists:users,id',
            'coordinator' => 'required|integer|in_array:lecturers.*'
        ]);
    }

    public function checkCount($data){
        if(count($data) > 2){
            return false;
        }else{
            return true;
        }
    }

    public function validateAllocateLecturer(Request $request){
        $year = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        $lecturer_data = $request['lecturers'];

        $error_array = array();

        $lecturer_count = Courses::whereHas('lecturers', function($query) use ($request,$year){
            $query->where('year',$year->year)->where('semester',$year->semester)->where('course_id',$request['course']);
        })->count();

        if($lecturer_count == 2){
            $error_array['final'] = "Only 2 lecturers allowed to coordinate a course";
        }

        foreach($lecturer_data as $data){

            $allocated_status = Courses::whereHas('lecturers', function ($query) use ($request,$year,$data){
                $query->where('course_id',$request['course'])->where('session_id',$year->id)->where('lecturer_id',$data);
            })->count();
                if($allocated_status > 0){
                    $dd = User::find($data);
                    $course = Courses::find($request['course']);
                    $error_array[$data] = $dd->firstname." ".$dd->lastname." ".$dd->middlename." has been allocated already to ".$course->title;
                }
        }



        if(count($error_array) == 0){
            return true;
        }else{
            return $error_array;
        }

    }

    public function allocateLecturers(Request $request){
        $validation = $this->validateLecturers($request);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->getMessageBag());
        }

        $validation2 = $this->checkCount($request['lecturers']);
            if($validation2 == false){
                Session::put('red',1);
                return redirect()->back()->withErrors('Only 2 Lecturers can be allocated to a course');
            }

            if($validation2 == true){
                $mainvalidation = $this->validateAllocateLecturer($request);
                if(is_array($mainvalidation)){
                    Session::put('red',1);
                    return redirect()->back()->withErrors($mainvalidation);
                }else{
                $current_session = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();

                $course = Courses::find($request['course']);
                foreach($request['lecturers'] as $lecturer){

                    $lecturer_data = User::find($lecturer);
                    if($request['coordinator'] == $lecturer){

                        $course->lecturers()->save($lecturer_data,['session_id' => $current_session->id, 'co_ordinator' => '1']);
                    }else{
                    $course->lecturers()->save($lecturer_data,['session_id' => $current_session->id,'co_ordinator' => '0']);
                }
                }
            }
            }
            Session::put('green',1);
            return redirect()->back()->withErrors('Lecturers have been allocated successfully');

            }

            public function getResult(Request $request,$course_id,$session_id,$matric_no){
                $mat = str_replace('-','/',$matric_no);
                $student = User::where('identification_number',$mat)->first();

                if($student == null){
                    $stat = array('status' => 'failure');
                    $message = array('message' => 'This Matriculation Number is Invalid');
                }else{

                    $result = $student->results()->where('session_id',$session_id)->where('course_id',$course_id)->first();

                    if($result == null){
                    $stat = array('status' => 'no_result');
                    $message = array('message' => 'No Result Exist for this Student in this course');
                }else{
                    $stat = array('status' => 'success');
                    $return_array = array('course'=>$result->title.'('.$result->code.')','assessment' =>$result->pivot->assessment_score,
                    'exam' => $result->pivot->exam_score,'total' => $result->pivot->total_score, 'grade' => $result->pivot->grade, 'id' => $result->pivot->id);
                    $message = array('result' => $return_array);
                }

                }


                return response()->json([$message,$stat])->header('Content-type', "application/json");
            }

            public function validateResult(Request $request){
                return Validator::make($request->except('_token'),[
                    'assessment_score' => 'required|integer|between:0,30',
                    'examination_score' => 'required|integer|between:0,70',
                    'result_id' => 'required|integer'
                ]);
            }

            public function changeResult(Request $request){
                $validation = $this->validateResult($request);
                if($validation->fails()){
                    Session::put('red',1);
                    return redirect()->back()->withErrors($validation->getMessageBag());
                }else{
                    $result = Results::find($request['result_id']);
                    $result->assessment_score = $request['assessment_score'];
                    $result->exam_score = $request['examination_score'];
                    $result->total_score = $request['examination_score'] + $request['assessment_score'];
                    $result->grade = $this->getGrade($request['examination_score'] + $request['assessment_score']);
                    $result->save();
                    Session::put('green',1);
                    return redirect()->back()->withErrors("Result has been Edited successfully");
                }

            }

            public function getGrade($total_mark){
                if($total_mark <= 49 ){
                    $grade = "F";
                }else if($total_mark >= 50 && $total_mark <=59){
                    $grade = "C";
                }else if($total_mark >= 60 && $total_mark <=69){
                    $grade = "B";
                }else if($total_mark >= 70 ){
                    $grade = "A";
                }
                return $grade;
            }

            public function getAll(Request $request,$matric){
                $mat = str_replace('-','/',$matric);
                $student = User::where('identification_number',$mat)->first();
                if($student == null){
                    $status = array('status' => 'failure');
                    $response = array('message' => 'This Matriculation Number is Invalid');
                return response()->json([$response,$status])->header('Content-type', "application/json");

                }elseif($student->programme_id != '2' && $student->programme_id != '3'){
                    $status = array('status' => 'failure');
                    $response = array('message' => 'This Student is not a M.Sc/PHD Student');
                return response()->json([$response,$status])->header('Content-type', "application/json");
                }else{
                $user = array('student' => $student->firstname.' '.$student->lastname.' '.$student->middlename.' - '.$student->identification_number);
                $i = 0;
                $results_array = array();
                $other_session = CurrentSession::where('id','>=',$student->session_of_admission)->where('department_id',$student->department_id)->take($student->programme_id * 2)->get();
                $collection = collect([]);
                foreach($other_session as $sess){
                    $results = $student->results()->where('session_id',$sess->id)->get();
                    $sem =$this->getSemesterResult($results);

                    $show = $sess->year.'/'.($sess->year+1).' '.$this->getSem($sess->semester).' Semester Results';
                    $results_array[$show] = $sem;
                    $i++;
                }
                $status = array('status' => 'success');
                $response = array('results' => $results_array);
            }
                if($request->isMethod('post')){
                    return [$response,$user];
                }else{
                    return response()->json([$response,$status,$user])->header('Content-type', "application/json");

                }

            }

            public function getSemesterResult($result_array){
                $returnArray = array();
                $resultArray = array();
                $i = 0;
                    foreach($result_array as $result){
                        $returnArray['course'] = $result->title;
                        $returnArray['code'] = $result->code;
                        $returnArray['grade'] = $result->pivot->grade;
                        $returnArray['credit_hour'] = $result->credit_hour;
                        $resultArray[$i] = $returnArray;
                        $i++;

                    }
                    if(!empty($resultArray)){
                        return $resultArray;
                    }



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

            public function downloadTranscript(Request $request){
                $mat = str_replace('-','/',$request['student_id']);
                $student = User::where('identification_number',$mat)->first();
                $returns = $this->getAll($request,$mat);
                $pdf = PDF::loadView('admin.main_transcript',['results' => $returns[0],'student' => $student ])->setPaper('a4', 'landscape');
                 return $pdf->download($student->identification_number.'_'.'Transcript.pdf');
                return view('admin.main_transcript',['results'=>$returns[0],'student'=>$student]);
            }

            public function endSession(Request $request){
                $session_id = CurrentSession::find($request['session_id']);
                $session_id->running = '0';
                $session_id->save();
                Session::put('green',1);
                    return redirect()->route('admin_home')->withErrors("Session has been Terminated Successfully");
            }

            public function downloadAdmissionFormat(Request $request){
                return Excel::download(new DownloadFormat, 'admission_format.xlsx');
            }


            public function pgdResults(Request $request){
                $id = $request['year'];
                $admitted_session = CurrentSession::find($id);
                $admitted_year = $admitted_session->year;
                $admitted_students = User::where('session_of_admission',$id)->where('programme_id','1')->where('department_id',Auth::guard('my_users')->user()->department_id)->get();
                $i = 0;
                $courses_first = Courses::where('programme_id','1')->where('semester','1')->get();
                $courses_second = Courses::where('programme_id','1')->where('semester','2')->get();

                foreach($admitted_students as $student){
                    $student_name = $student->firstname." ".$student->lastname." ".$student->middlename." ".$student->identification_number;
                    $results[$student_name] = [
                        $this->studentResult($student->id)
                    ];
                }

                $pdf = PDF::loadView('admin.pgd_result_table',['first_sem' => $courses_first,'second_sem' => $courses_second,'results' => $results,'year' => $admitted_year])->setPaper('a2', 'landscape');
                return $pdf->download($admitted_year." - ".($admitted_year+1).' PGD Programme Computer Science Transcript.pdf');

            }

            public function studentResult($user_id){
                $user = User::find($user_id);
                $res = array();

                foreach($user->results as $result){
                    $res[$result->code] = $result->pivot->grade;
                }

                return $res;
            }

            public function mscResults(Request $request){
                $student_data = $this->getAll($request,$request['student_id']);
              $first_year_results = array_slice($student_data['0']['results'],0,2);
              $second_year_results = array_slice($student_data['0']['results'],2);
              $first_key = array_keys($first_year_results);
              $second_key = array_keys($second_year_results);
                $first_sess = explode(' ',$first_key[0]);
                $second_sess = explode(' ',$second_key[0]);

                $pdf = PDF::loadView('admin.msc_result_table',['first_year' => $first_year_results,'second_year' => $second_year_results,'student_name' => $student_data[1]['student'],
                'first_sess' => $first_sess[0],'second_sess' => $second_sess[0]])->setPaper('a3', 'landscape');
                return $pdf->download($student_data[1]['student']." - ".'Transcript.pdf');
            }
    }


