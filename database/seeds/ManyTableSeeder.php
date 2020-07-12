<?php

use Illuminate\Database\Seeder;
use App\Model\Courses;
use App\Model\User;
use App\Model\LecturerCourses;
use App\Http\Middleware\Lecturer;
use App\Model\StudentCourses;
use App\Model\Results;
class ManyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        $pgd_codes = ['501','511','531','541','551','502','522','532','542','552'];
        $msc_codes = ['601','611','621','631','602','632','622','612','690'];
          $pgd_courses = [
              'Operation Research',
              'Artificial Intelligence',
              'Computational Biology',
              'Human Computer Interaction',
              'Programming Languages',
              'Theory of Computing',
              'Database Management',
              'Computer Networking',
              'Operating Systems',
              'Computer Hardware'
          ];

          for($i = 0;$i < count($pgd_courses); $i++){
              if($i >= 5){
                  $semester = 2;
              }else{
                  $semester = 1;
              }
              Courses::create([
                  'title' => $pgd_courses[$i],
                  'code' => 'CSC '.rand(500,599),
                  'department_id' => '1',
                  'programme_id' => '1',
                  'credit_hour' => '3',
                  'year' => '1',
                  'semester' => $semester
              ]);
          }

          $msc_courses = [
            'Discrete Structures',
            'Data Structures',
            'Computer Security',
            'Object Oriented Programming',
            'Structured Programming',
            'Computational Analysis',
            'Algorithms',
            'Computer History',
            'Project'
        ];
        $start = 500;
        for($i = 0;$i < count($msc_courses); $i++){
            if($i <= 4){
                $semester = 1;
                $year = '1';
            }elseif(($i >= 4) & ($i <= 7)){
                $year = '1';
                $semester = 2;
            }else{
                $year = '2';
                $semester = 1;
            }
                    Courses::create([
                        'title' => $msc_courses[$i],
                        'code' => 'CSC '.rand(600,699),
                        'department_id' => '1',
                        'programme_id' => '2',
                        'credit_hour' => '3',
                        'year' => $year,
                        'semester' => $semester
                    ]);

        }

        $lecturers = User::where('role','6')->where('department_id','1')->where('programme_id','1')->get();
        $courses = Courses::where('programme_id','1');
        $last = '1';
        foreach($courses as $course){

            foreach($lecturers as $lecturer){
                if($last == '1'){
                    $last = '0';
                }else{
                    $last = '1';
                }
                LecturerCourses::create([
                    'lecturer_id' => $lecturer->id,
                    'course_id' => $course->id,
                    'session_id' => $course->semester,
                    'co_ordinator' => $last
                ]);
            }

        }

        $lecturers = User::where('role','6')->where('department_id','1')->where('programme_id','2')->get();
        $courses = Courses::where('programme_id','2');
        $last = '1';
        foreach($courses as $course){

            foreach($lecturers as $lecturer){
                if($last == '1'){
                    $last = '0';
                }else{
                    $last = '1';
                }
                if($course->year == '2'){
                    $session_id = '3';
                }else{
                    $session_id = $course->semester;
                }
                LecturerCourses::create([
                    'lecturer_id' => $lecturer->id,
                    'course_id' => $course->id,
                    'session_id' => $session_id,
                    'co_ordinator' => $last
                ]);
            }

        }

        $programmes = ['1','2'];
        foreach($programmes as $programme){
            $students = User::where('role','7')->where('programme_id',$programme)->get();
            $courses = Courses::where('programme_id',$programme)->get();

            foreach($courses as $course){

                if($course->year == '2'){
                    $session_id = '3';
                }else{
                    $session_id = $course->semester;
                }
                foreach($students as $student){

                    StudentCourses::create([
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'session_id' => $session_id,
                    ]);
                }

            }
        }


        $students_registration = StudentCourses::all();

            foreach($students_registration as $registration){
                $assessment_score = rand(20,30);
                $exam_score = rand(30,70);
                $total = $assessment_score + $exam_score;
                Results::create([
                    'course_reg_id' => $registration->id,
                    'student_id' => $registration->student_id,
                    'course_id' => $registration->course_id,
                    'session_id' => $registration->session_id,
                    'assessment_score' => $assessment_score,
                    'exam_score' => $exam_score,
                    'total_score' => $total,
                    'grade' => $this->getGrade($total)
                ]);
            }

    }

    public function getGrade($total_mark){
        if($total_mark <= 49){
            $grade = "F";
        }else if($total_mark >= 50 && $total_mark <=59){
            $grade = "C";
        }else if($total_mark >= 60 && $total_mark <=69){
            $grade = "B";
        }else if($total_mark >= 70 ){
            $grade = "A";
        }
        return $grade;
    }
}
