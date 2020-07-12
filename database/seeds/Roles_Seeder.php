<?php
use App\Model\Roles;
use Illuminate\Database\Seeder;

class Roles_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(['Super Administrator','Super Admin'],['Dean Graduate School','Dean Grad. Sch'],['Chairman, Faculty Graduate Commission','Chairman, Fac. Grad. Comm'],['Chairman, Department Graduate Commission','Chairman, Dept Grad. Comm'],['Head of Deparment','Head of Dept'],['Lecturer','Lect.'],[ 'Student','Stud.']) ;
        $i = 1;
        foreach($roles as $key =>$role ){

            $roles = Roles::create([
                'fullname' => $role[0],
                'shortname' => $role[1],
                ]);
                $i = $i + 1;
        }


    }
}
