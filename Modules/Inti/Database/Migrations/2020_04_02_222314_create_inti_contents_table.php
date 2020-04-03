<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntiContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inti_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->text('body')->nullable();

            $table->unsignedBigInteger('inti_course_id');
            $table->foreign('inti_course_id')->references('id')->on('inti_courses');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inti_contents');
    }
}
