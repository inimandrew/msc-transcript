<?php

namespace App\Imports;
use App\Model\User;
use App\Model\Results;
use App\Model\Batch;
use Validator;
use Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Result implements ToCollection,withHeadingRow
{
    private $course_id;
    private $session_id;
    public $validation_error = 0;

    public function __construct($course_id,$session_id){
        $this->course_id = $course_id;
        $this->session_id = $session_id;
    }

    public function getCourseId(){
        return $this->course_id;
    }

    public function getSessionId(){
        return $this->session_id;
    }

    public function validateData($data){
        $messages = [
            '*.matriculation_number.required' => ':attribute is empty',
            '*.assessment_score.required' => ':attribute column is empty ',
            '*.examination_score.required' => ':attribute column is empty',
            '*.assessment_score.integer' => ':attribute column may contain only numbers',
            '*.examination_score.integer' =>':attribute column may contain only numbers',
            '*.assessment_score.between' => ':attribute value :input must be between :min and :max',
            '*.examination_score.between' => ':attribute value :input must be between :min and :max'
        ];

        $rules =[
            '*.matriculation_number' => 'required|exists:users,identification_number',
            '*.assessment_score' => 'required|integer|between:0,30',
            '*.examination_score' => 'required|integer|between:0,70'
        ];

    return Validator::make($data,$rules,$messages);
}

    public function collection(Collection $collections){
        $validation = $this->validateData($collections->toArray());
        $i = 0;
        if($validation->fails()){
            $this->validation_error = 1;
            $messages = $validation->getMessageBag();
        $this->messages = $messages;
        }else{
            $new_error = array();
            $lecturer = Auth::guard('my_users')->user();
            $batch_upload = Batch::create([
                'department_id'=>$lecturer->department_id,
                'lecturer_id' => $lecturer->id,
                'session_id' => $this->getSessionId(),
                'course_id' => $this->getCourseId()]);

                if($batch_upload){

                    foreach($collections as $collection){
                        $user = User::where('identification_number',$collection['matriculation_number'])->first('id');
                        $user_check = $this->checkIfResultExists($user->id);
                        if($user_check > '0'){
                            $new_error[$i] = "warning,Result has already been uploaded for ".$collection['matriculation_number']." for this course in this session/semester";
                        }else{
                            $user = User::where('identification_number',$collection['matriculation_number'])->first();
                            $student = $user->courses1()->where(['session_id' => $this->getSessionId(),'course_id' => $this->getCourseId()])->first();
                                $new_result = Results::create([
                                'course_reg_id' => $student->pivot->id,
                                'course_id' => $this->getCourseId(),
                                'session_id' => $this->getSessionId(),
                                'student_id' =>$user->id,
                                'assessment_score' => $collection['assessment_score'],
                                'exam_score' => $collection['examination_score'],
                                'total_score' => $collection['assessment_score'] + $collection['examination_score'],
                                'grade' => $this->getGrade($collection['assessment_score'] + $collection['examination_score'])
                            ]);
                            $new_error[$i] = "success,Result successfully uploaded for ".$collection['matriculation_number'];
                        }
$i++;
            }
        }
            $this->messages = $new_error;

        }

    }

    public function checkIfResultExists($id){
        $result = Results::where('course_id',$this->getCourseId())->where('session_id',$this->getSessionId())->where('student_id',$id)->count();
        return $result;
    }

    public function getGrade($total_mark){
        if($total_mark <= 49){
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

}
