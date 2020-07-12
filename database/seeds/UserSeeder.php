<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use App\Model\CurrentSession;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 2; $i++){
            CurrentSession::create([
                'year' => '2019',
                'semester' => $i+1,
                'start_on' => '2019-12-19',
                'end_on' => '2020-03-19',
                'department_id' => '1',
                'running' => (string) $i
            ]);
        }

        for($i = 0; $i < 2; $i++){
            CurrentSession::create([
                'year' => '2020',
                'semester' => $i+1,
                'start_on' => '2020-12-19',
                'end_on' => '2021-03-19',
                'department_id' => '1',
                'running' => (string) $i
            ]);
        }

        $admins = array("computeradmin" =>"Johnson Koman Effiong","geologyadmin" => "Adama Johnson Adama","mathematicsadmin" => "Okoro Joshua Okoro"
        ,"statisticsadmin" => "Edidiong Mathew Smart","physicsadmin" => "Ogbu Dennis Joshua","chemistryadmin" =>"Ikpe Margaret Brown");
        $i = 1;
            foreach($admins as $key => $admin){
                $name = explode(" ",$admin);
                $user = User::create([
                    'firstname' => $name[0],
                    'lastname' => $name[1],
                    'middlename' => $name[2],
                    'email' => $key.'@admin.com',
                    'identification_number' => $key,
                    'department_id' => $i,
                    'role' => '1',
                    'rank' => 'Post-Graduate Coordinator',
                    'password' => Hash::make('password')
                    ]);
                    $i = $i + 1;
            }


        for($i = 0; $i < 2; $i++){
            $names = $faker->name;
            $name1 = $faker->name;
            list($firstname,$lastname) = explode(' ',$names);
            list($middlename) = explode(' ',$name1);
            User::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'email' => $faker->unique()->email,
                'identification_number' => 'CSC/'.rand(100,999),
                'department_id' => '1',
                'role' => '6',
                'rank' => 'Lecturer',
                'password' => Hash::make('password')
            ]);
        }

        for($i = 0; $i < 5; $i++){
            $names = $faker->name;
            $name1 = $faker->name;
            list($firstname,$lastname) = explode(' ',$names);
            list($middlename) = explode(' ',$name1);
            User::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'email' => $faker->unique()->email,
                'identification_number' => 'CSC/PGD/'.random_int(100,999),
                'department_id' => '1',
                'role' => '7',
                'programme_id' => '1',
                'rank' => 'Student',
                'session_of_admission' => '1',
                'password' => Hash::make('password')
            ]);
        }

        for($i = 0; $i < 5; $i++){
            $names = $faker->name;
            $name1 = $faker->name;
            list($firstname,$lastname) = explode(' ',$names);
            list($middlename) = explode(' ',$name1);
            User::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'email' => $faker->unique()->email,
                'identification_number' => 'CSC/MSC/'.random_int(100,999),
                'department_id' => '1',
                'role' => '7',
                'programme_id' => '2',
                'rank' => 'Student',
                'session_of_admission' => '1',
                'password' => Hash::make('password')
            ]);
        }

        for($i = 0; $i < 5; $i++){
            $names = $faker->name;
            $name1 = $faker->name;
            list($firstname,$lastname) = explode(' ',$names);
            list($middlename) = explode(' ',$name1);
            User::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'email' => $faker->unique()->email,
                'identification_number' => 'CSC/PHD/'.random_int(100,999),
                'department_id' => '1',
                'role' => '7',
                'programme_id' => '3',
                'rank' => 'Student',
                'session_of_admission' => '1',
                'password' => Hash::make('password')
            ]);
        }

    }
}
