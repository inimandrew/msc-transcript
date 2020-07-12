<?php

namespace App\Imports;
use App\Model\User;
use Auth;
use App\Model\CurrentSession;
use Hash;
use Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public $messages;
    public $validation_error = 0;

    public function __construct($department_id,$programme_id){
        $this->department = $department_id;
        $this->programme = $programme_id;
    }

    public function current_session(){
        $current = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
        return $current;
    }

    public function validateData($data){
        if($this->programme == '1'){
            $messages = [
                '*.email.required' => 'email column is empty in one row in your file',
                '*.firstname.required' => 'firstname column is empty in one row in your file',
                '*.firstname.alpha' => 'firstname may contain only letters in your file',
                '*.lastname.required' => 'lastname column is empty in one row in your file',
                '*.lastname.alpha' => 'lastname column may contain only letters in your file',
                '*.middlename.required' => 'middlename column is empty in one row in your file',
                '*.middlename.alpha' => 'middlename may only contain letters in your file',
                '*.email.required' => 'email column is empty in one row in your file',
                '*.email.unique' => ':input is already taken',
                '*.email.email' => ':input is not a valid email address',
                '*.matriculation_number.required' => 'matriculation_number is empty in one row in your file',
                '*.matriculation_number.unique' => ':input Number is already taken',
            ];

            $rules =[
                '*.firstname' => 'required|alpha',
                '*.lastname' => 'required|alpha',
                '*.middlename' => 'required|alpha',
                '*.matriculation_number' => 'required|unique:users,identification_number',
                '*.email' => 'required|unique:users,email|email',

            ];
        }else{
            $messages = [
                '*.email.required' => 'email column is empty in one row in your file',
                '*.firstname.required' => 'firstname column is empty in one row in your file',
                '*.firstname.alpha' => 'firstname may contain only letters in your file',
                '*.lastname.required' => 'lastname column is empty in one row in your file',
                '*.lastname.alpha' => 'lastname column may contain only letters in your file',
                '*.middlename.required' => 'middlename column is empty in one row in your file',
                '*.middlename.alpha' => 'middlename may only contain letters in your file',
                '*.email.required' => 'email column is empty in one row in your file',
                '*.email.unique' => ':input is already taken',
                '*.email.email' => ':input is not a valid email address',
                '*.matriculation_number.required' => 'matriculation_number is empty in one row in your file',
                '*.matriculation_number.unique' => ':input Number is already taken',
                '*.specialty.required' => 'specialty is empty in one row in your file',
            ];

            $rules =[
                '*.firstname' => 'required|alpha',
                '*.lastname' => 'required|alpha',
                '*.middlename' => 'required|alpha',
                '*.matriculation_number' => 'required|unique:users,identification_number',
                '*.email' => 'required|unique:users,email|email',
                '*.specialty' => 'required'

            ];
        }

        return Validator::make($data,$rules,$messages);
    }


    public function collection(Collection $collections)
    {
        switch($this->programme){
            case '1':
            $this->postgraduateUpload($collections);
            break;

            case '2':
            case '3':
            $this->mastersAndDoctorUpload($collections);
            break;
        }

    }

    public function postgraduateUpload(Collection $collections){
        $messages = array();
        $i = 0;
        $validation = $this->validateData($collections->toArray());

        if($validation->fails()){
            $this->validation_error = 1;
            $messages = $validation->getMessageBag();
        }else{
            $current_sess = $this->current_session();

            foreach($collections as $collection){
                $user = User::create(['firstname' => ucfirst($collection['firstname']),'lastname' => ucfirst($collection['lastname']),'middlename' => ucfirst($collection['middlename']),
                'email' => $collection['email'],'identification_number' => $collection['matriculation_number'],'department_id' => $this->department,'programme_id' => $this->programme,
                'role' => '2','password' => Hash::make('password'),'session_of_admission'=>$current_sess->id]);
                $messages[$i] = 'success,'.$collection['matriculation_number']." registered Successfully.";
                $i = $i + 1;
            }
        }

        $this->messages = $messages;
    }

    public function mastersAndDoctorUpload(Collection $collections){
        $messages = array();
        $i = 0;
        $validation = $this->validateData($collections->toArray());

        if($validation->fails()){
            $this->validation_error = 1;
            $messages = $validation->getMessageBag();
        }else{
            $current_sess = $this->current_session();
            foreach($collections as $collection){
                $user = User::create(['firstname' => ucfirst($collection['firstname']),'lastname' => ucfirst($collection['lastname']),'middlename' => ucfirst($collection['middlename']),
            'email' => $collection['email'],'identification_number' => $collection['matriculation_number'],'department_id' => $this->department,'programme_id' => $this->programme,
            'specialty' => ucwords($collection['specialty']),'role' => '2','password' => Hash::make('password'),'session_of_admission'=>$current_sess->id]);

            $messages[$i] = 'success,'.$collection['matriculation_number']." registered Successfully.";
            $i = $i + 1;
        }
    }

        $this->messages = $messages;

    }


}
