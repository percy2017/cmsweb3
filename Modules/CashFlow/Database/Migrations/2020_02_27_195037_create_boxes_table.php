<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->decimal('start_amount',8,2);
            $table->decimal('balance',8,2)->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('user_id')->references('id')->on('users');
         
            $table->softDeletes();
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
        Schema::dropIfExists('boxes');
    }
}
