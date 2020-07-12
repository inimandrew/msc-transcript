<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurrentSession extends Model
{
    protected $table = 'current_session';
    protected $fillable = [
        'year', 'semester', 'start_on' ,'end_on' ,'running','department_id'
    ];
    public $timestamps = false;

    public function lecturer_courses(){
        return $this->belongsTo(LecturerCourses::class);
    }


}
