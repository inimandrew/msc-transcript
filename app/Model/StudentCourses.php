<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentCourses extends Model
{
    protected $table = "student_courses";
    public $timestamps = false;

    protected $fillable = [
        'course_id', 'student_id', 'session_id'
    ];
}
