<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@index')->name('home');

Route::post('login', 'LoadController@login')->name('login_user');

Route::group(['middleware' => 'user'], function () {

    Route::group(['prefix' => 'admin','middleware' => 'admin','namespace' => 'Admin'], function () {

        Route::get('home','PageController@home')->name('admin_home');

        Route::get('courses','PageController@courseRegisterPage')->name('register_course_page');

        Route::post('courses','LoadController@registerCourse')->name('register_course_action');

        Route::get('students','PageController@studentRegistrationPage')->name('register_student_page');

        //Route::post('students','LoadController@registerStudent')->name('register_student_action');

        Route::post('students','LoadController@registerStudents')->name('register_student_action');

        Route::get('lecturers','PageController@lecturerRegistrationPage')->name('register_lecturer_page');

        Route::post('lecturers','LoadController@registerLecturer')->name('register_lecturer_action');

        Route::get('session_schedule','PageController@schedule_page')->name('session_scheduler');

        Route::post('session_schedule','LoadController@scheduleAction')->name('session_scheduler_action');

        Route::get('allocation','PageController@allocationPage')->name('allocate_lecturer_page');

        Route::post('allocation','LoadController@allocateLecturers')->name('allocate_lecturer_action');

        Route::get('edit_result','PageController@resultEditPage')->name('edit_result');

        Route::get('get_result/{course_id}/{session_id}/{matric_no}','LoadController@getResult')->name('get_result');

        Route::post('change_result','LoadController@changeResult')->name('change_result');

        Route::get('transcriptPage','PageController@transcriptPage')->name('transcript');

        Route::get('pdg_transcript','PageController@pgd_transcriptPage')->name('pgd_transcript');

        Route::get('get_results_all/{matric}','LoadController@getAll');

        Route::post('download_transcript','LoadController@downloadTranscript')->name('final_transcript');

        Route::get('lecturer_results','PageController@resultUploads')->name('lecturers_upload');

        Route::get('end_session','PageController@endSessionPage')->name('end_session');

        Route::post('end_session','LoadController@endSession')->name('end_session_action');

        Route::get('download_admission_format','LoadController@downloadAdmissionFormat')->name('admission_format');

        Route::post('results/pgd','LoadController@pgdResults')->name('pgd_transcript_action');

        Route::post('results/msc','LoadController@mscResults')->name('msc_transcript_action');
    });

    Route::get('edit_profile_page','PageController@EditProfile')->name('edit_profile');

    Route::post('edit_profile_action','PageController@EditProfile')->name('edit_profile_action');

    Route::get('logout','LoadController@logout')->name('logout');

    Route::get('view_results/{session_id}/{course_id}','Lecturer\LoadController@getResultsPage')->name('view_results');


    Route::group(['prefix' => 'lecturer','namespace' => 'Lecturer','middleware' => 'lecturer'], function () {

        Route::get('home','PageController@lecturerHome')->name('lecturer_home');

        Route::get('allocated_courses','PageController@allocatedPage')->name('allocated_courses');

        Route::get('history','PageController@CourseHistory')->name('lecture_history');

        Route::post('registration_list','LoadController@getList')->name('list');

        Route::get('results/{session_id}/{course_id}','PageController@resultPage')->name('result_upload');

        Route::post('results_upload','LoadController@uploadResult')->name('result_upload_action');

    });

    Route::group(['prefix' => 'student', 'middleware' => 'student', 'namespace' => 'Student'], function () {
        Route::get('home','PageController@studentHome')->name('student_home');

        Route::get('registration','PageController@courseRegistrationPage')->name('course_registration');

        Route::post('registration','LoadController@courseRegistrationAction')->name('registration_action');

        Route::get('results','PageController@getResultsPage')->name('result_page');

        Route::get('get_results','LoadController@getResults')->name('result_check');

    });

});


