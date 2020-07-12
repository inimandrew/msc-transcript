<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table ="departments";

    public function user(){
        return $this->belongsTo(User::class);
    }
}
