<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntiChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inti_chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transmitter')->nullable();
            $table->string('receiver')->nullable();

            $table->string('type_message')->nullable();
            $table->string('message')->nullable();

            $table->unsignedBigInteger('live_id');
            $table->foreign('live_id')->references('id')->on('inti_lives');

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
        Schema::dropIfExists('inti_chats');
    }
}
