<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanes_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('plane')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->double('price')->nullable();
            $table->dateTime('renovation')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('quantity_profiles')->nullable();
            $table->string('payment')->nullable();

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
        Schema::dropIfExists('sanes_accounts');
    }
}
