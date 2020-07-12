<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrentSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_session', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->enum('semester',['1','2']);
            $table->date('start_on');
            $table->date('end_on');
            $table->integer('department_id');
            $table->enum('running',['0','1']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_session');
    }
}
