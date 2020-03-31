<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanes_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->dateTime('startdate')->nullable();
            $table->dateTime('finaldate')->nullable();
            $table->string('observation')->nullable();

            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('sanes_accounts');

            $table->unsignedBigInteger('membership_id');
            $table->foreign('membership_id')->references('id')->on('sanes_memberships');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('sanes_profiles');
    }
}
