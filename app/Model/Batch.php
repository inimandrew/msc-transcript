<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = "batch_upload";

    protected $fillable = [
        'department_id', 'lecturer_id' , 'course_id', 'session_id'
    ];

    public function lecturer(){
        return $this->hasOne(User::class,'id','lecturer_id');
    }

    public function course(){
        return $this->hasOne(Courses::class,'id','course_id');
    }
    public function session(){
        return $this->hasOne(CurrentSession::class,'id','session_id');
    }
}
