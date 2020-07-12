<?php

namespace App\Imports;

use App\Model\User;
use App\Model\CurrentSession;
use App\Model\Programme;
use App\Model\AdmissionFormat as Admitted;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
use Hash;
use Validator;

class AdmissionFormat implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    public $messages;
    public $programme;
    public $validation_error = 0;

    public function __construct($programme)
    {
        $this->programme = $programme;
    }
    public function current_session(){
        $current = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        return $current;
    }

    public function validateFileImport(array $data){
        $rules = [
            "*.candidate_full_name" => 'required|string',
            "*.status" => 'required|string',
            "*.qualification" => 'required|string',
            "*.year_of_graduation" => 'required|integer',
            '*.university' => 'required|string',
            "*.class_of_degree" => 'required',
            "*.degree_in_view" => 'required|string',
            "*.referee_report_received" => 'required|numeric',
            "*.transcript_received_gpa" => 'required|numeric',
            "*.concept_note" => 'required|string',
            "*.written_score" => 'required|numeric',
            "*.oral_score" => 'required|numeric',
            "*.departmental_graduate_committee_recommendation" => 'required|string',
            "*.faculty_graduate_committee_recommendation" => 'required|string',
             "*.graduate_school_recommendation" => 'required|string'
            ];

            return Validator::make($data,$rules);
    }

    public function collection(Collection $collections)
    {
        $validation = $this->validateFileImport($collections->toArray());
        $current_session = $this->current_session();
        $year = substr($current_session->year, -2);

        $i = 1;
            if($validation->fails()){
                $this->validation_error = 2;
                $this->messages = $validation->errors();
            }else{
                foreach($collections as $collection){
                    list($firstname,$lastname,$middlename) = explode(" ",$collection['candidate_full_name']);
                    $success = User::create(['firstname'  => ucfirst(strtolower($firstname)), 'lastname' => ucfirst(strtolower($lastname)), 'middlename' => ucfirst(strtolower($middlename)),
                            'identification_number' => "CSC/".$this->returnProgramme($this->programme)."/".$year."/".$this->returnValidNumber($i),
                            'programme_id' => $this->programme,'department_id' => Auth::guard('my_users')->user()->department_id,'password' => Hash::make("password"),
                            'session_of_admission' => $current_session->id, 'rank' => 'Student','role' => '7'
                            ]);
                            $i++;

                            if($success){
                                $admit_record = Admitted::create([
                                    'user_id' => $success->id, 'status' => $collection['status'], 'qualification' => $collection['qualification'],
                                    'year_of_graduation' => $collection['year_of_graduation'], 'class_of_degree' => $collection['class_of_degree'],
                                    'degree_in_view' => $collection['degree_in_view'],'reports_recieved' => $collection['referee_report_received'],
                                    'transcript_recieved_gpa' => $collection['transcript_received_gpa'],'concept_note' => $collection['concept_note'],
                                    'written_score' => $collection['written_score'],'oral_score' => $collection['oral_score'],'university' => $collection['university'],
                                    'dept_grad_rec' => $collection['departmental_graduate_committee_recommendation'],
                                    'fac_grad_rec' => $collection['faculty_graduate_committee_recommendation'],
                                    'grad_sch_rec' => $collection['graduate_school_recommendation']
                                ]);
                $this->validation_error = 3;

                                $this->messages = ['Students Uploaded Successfully'];
                            }
                }
            }
    }

    public function returnProgramme($programme_id){
        $programme = Programme::find($programme_id);
        return $programme->short_form;
    }

    public function returnValidNumber($i){
        if(strlen(((string) $i)) == 1){
            return "00".$i;
        }else if(strlen($i) == 2){
            return "0".$i;
        }else{
            return $i;
        }
    }
}
