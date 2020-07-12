<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          $this->call(facultySeeder::class);
           $this->call(DepartmentSeeder::class);
           $this->call(ProgrammeSeeder::class);
           $this->call(Roles_Seeder::class);
          $this->call(UserSeeder::class);
         $this->call(ManyTableSeeder::class);
    }
}
