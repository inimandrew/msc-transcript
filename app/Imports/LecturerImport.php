<?php

namespace App\Imports;
use App\Model\User;
use Validator;
use Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class LecturerImport implements ToCollection, withHeadingRow
{
    public $messages;
    public $validation_error = 0;

    public function __construct($department_id){
        $this->department = $department_id;
    }

    public function validateData($data){
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
                '*.staff_id.required' => 'matriculation_number column is empty in one row in your file',
                '*.staff_id.unique' => ':input Number is already taken',
                '*.specialty.required' => 'specialty column is empty in one row in your file',
                '*.rank.required' => 'rank column is empty in one row in your file'
            ];

            $rules =[
                '*.firstname' => 'required|alpha',
                '*.lastname' => 'required|alpha',
                '*.middlename' => 'required|alpha',
                '*.staff_id' => 'required|unique:users,identification_number',
                '*.email' => 'required|unique:users,email|email',
                '*.specialty' => 'required',
                '*.rank' => 'required'
            ];

        return Validator::make($data,$rules,$messages);
    }

    public function collection(Collection $collections)
    {
        $messages = array();
        $i = 0;
        $validation = $this->validateData($collections->toArray());

        if($validation->fails()){
            $this->validation_error = 1;
            $messages = $validation->getMessageBag();
        }else{
            foreach($collections as $collection){
                    $user = User::create(['firstname' => ucfirst($collection['firstname']),'lastname' => ucfirst($collection['lastname']),'middlename' => ucfirst($collection['middlename']),
                    'email' => $collection['email'],'identification_number' => $collection['staff_id'],'department_id' => $this->department,'rank' => $collection['rank'],'specialty' => $collection['specialty'],'role' => '1','password' => Hash::make('password')]);

            $messages[$i] = 'success,'.$collection['staff_id']." registered Successfully.";

            $i = $i + 1;
        }
        }


        $this->messages = $messages;
    }


}
