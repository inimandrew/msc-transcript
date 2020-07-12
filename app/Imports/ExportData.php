<?php

namespace App\Imports;
use App\Model\User;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ExportData implements FromView, ShouldAutoSize
{
    private $session_id;
    private $course_id;

    public function __construct($course_id,$session_id){
        $this->course_id = $course_id;
        $this->session_id = $session_id;

    }

    public function view(): View
    {
        $students = User::whereHas('courses1', function($query){
            $query->where('course_id',$this->course_id)->where('session_id',$this->session_id);
        })->get();
        return view('lecturer.export', [
            'users' =>$students
        ]);
    }

}
