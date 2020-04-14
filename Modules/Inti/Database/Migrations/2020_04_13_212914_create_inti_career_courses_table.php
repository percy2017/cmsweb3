<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntiCareerCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inti_career_courses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('career_id');
            $table->foreign('career_id')->references('id')->on('inti_careers');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('inti_courses');

            
            
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
        Schema::dropIfExists('inti_career_courses');
    }
}
