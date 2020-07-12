<?php

namespace App\Http\Controllers;
use App\Model\User;
use App\Model\Results;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function getMscResult($identification_number){
        $user = User::where('identification_number',$identification_number)->first();
        $results = $user->results();
    }
}
