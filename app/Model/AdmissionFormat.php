<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdmissionFormat extends Model
{
    protected $table = "admission_format";

    protected $fillable = [
        "user_id","status","qualification","university","year_of_graduation","class_of_degree","reports_recieved", 'degree_in_view',
        "transcript_recieved_gpa","concept_note","oral_score","written_score","dept_grad_rec","fac_grad_rec","grad_sch_rec"
    ];

    public $timestamps = false;
}
