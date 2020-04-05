<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntiTrainerCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inti_trainer_courses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('inti_courses');

            $table->unsignedBigInteger('trainer_id');
            $table->foreign('trainer_id')->references('id')->on('inti_trainers');
            
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
        Schema::dropIfExists('inti_trainer_courses');
    }
}
