<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $table = "results";

    public $timestamps = false;

    protected $fillable = [
        'course_reg_id','course_id', 'student_id' , 'grade', 'assessment_score', 'exam_score', 'session_id','total_score'
      ];

    public function student(){
        return $this->hasOne(User::class,'id','student_id');
    }

    public function courses(){
        return $this->hasOne(Courses::class,'id','course_id');
    }

    public function session_check(){
        return $this->hasOne(CurrentSession::class,'id','session_id');
    }
}
