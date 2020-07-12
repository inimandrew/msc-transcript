<?php

use Illuminate\Database\Seeder;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programmes = array("PGD" =>"Postgraduate Diploma,1","M.Sc" => "Master of Science,2","PhD" => "Doctor of Philosophy,3");

        foreach($programmes as $key => $programme){
            $prog = explode(',',$programme);

            DB::table('programmes')->insert([
                'full_form' => $prog[0],
                'no_of_years' => $prog[1],
                'short_form' => $key
                ]);
        }

    }
    }

