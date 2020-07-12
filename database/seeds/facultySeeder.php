<?php

use Illuminate\Database\Seeder;

class facultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            'name' => "Physical Science"
            ]);
    }
}
