<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = "courses";
    public $timestamps = false;

    public function lecturers(){
        return $this->belongsToMany(User::class,'lecturer_courses','course_id','lecturer_id')->withPivot('co_ordinator','session_id');
    }

    public function students(){
        return $this->belongsToMany(User::class,'student_courses','course_id','student_id')->withPivot('session_id','id');
    }

}
