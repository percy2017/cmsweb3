<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanes_seatings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('concept')->nullable();
            $table->decimal('amount',8,2)->nullable();
            $table->string('type')->nullable();
            
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('box_id');
            $table->foreign('box_id')->references('id')->on('sanes_boxes');
            
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
        Schema::dropIfExists('sanes_seatings');
    }
}
