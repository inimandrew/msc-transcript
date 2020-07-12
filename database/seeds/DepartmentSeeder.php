<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = array("CSC" =>"Computer Science","GLG" => "Geology","MTH" => "Mathematics","STA" => "Statistics","PHY" => "Physics","CHM" =>"Chemistry");

        foreach($departments as $key => $department){
            DB::table('departments')->insert([
                'name' => $department,
                'faculty_id' => 1,
                'short_form' => $key
                ]);
        }

    }
}
