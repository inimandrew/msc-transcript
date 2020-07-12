<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname' , 'middlename', 'password', 'role','identification_number','department_id','programme_id','role','rank','specialty','session_of_admission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(){
        return $this->belongsToMany(Courses::class,'lecturer_courses','lecturer_id','course_id')->withPivot('co_ordinator','session_id');
    }

    public function courses1(){
        return $this->belongsToMany(Courses::class,'student_courses','student_id','course_id')->withPivot('session_id','id');
    }

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function programme(){
        return $this->hasOne(Programme::class,'id','programme_id');
    }

    public function result(){
        return $this->belongsTo(Results::class);
    }

    public function session_admitted(){
        return $this->hasOne(CurrentSession::class,'id','session_of_admission');
    }

    public function results(){
        return $this->belongsToMany(Courses::class,'results','student_id','course_id')->withPivot('course_reg_id','assessment_score','exam_score',
        'total_score','grade','session_id','id');
       }


}
