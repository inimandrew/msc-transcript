<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LecturerCourses extends Model
{
    protected $table = "lecturer_courses";
    public $timestamps = false;

    public function courses(){
        return $this->hasOne(Courses::class,'id','course_id');
    }

    public function lecturers(){
        return $this->hasMany(User::class,'id','lecturer_id');
    }

    public function session_taught(){
        return $this->hasOne(CurrentSession::class,'id','session_id');
    }
}
