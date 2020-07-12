<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('email')->unique()->nullable();
            $table->string('identification_number')->unique();
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->integer('programme_id')->nullable()->unsigned();
            $table->foreign('programme_id')->references('id')->on('programmes');
            $table->integer('session_of_admission')->nullable()->unsigned();
            $table->foreign('session_of_admission')->references('id')->on('current_session');
            $table->string('rank')->nullable();
            $table->string('specialty')->nullable();
            $table->integer('role')->unsigned();
            $table->foreign('role')->references('id')->on('roles')->onDelete('cascade');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
