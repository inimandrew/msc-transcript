<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdmissionFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_format', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status');
            $table->string('qualification');
            $table->string('university');
            $table->string('year_of_graduation');
            $table->string('class_of_degree');
            $table->string('degree_in_view');
            $table->string('reports_recieved');
            $table->string('transcript_recieved_gpa');
            $table->mediumText('concept_note');
            $table->integer('oral_score');
            $table->integer('written_score');
            $table->mediumText('dept_grad_rec');
            $table->mediumText('fac_grad_rec');
            $table->mediumText('grad_sch_rec');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_format');
    }
}
