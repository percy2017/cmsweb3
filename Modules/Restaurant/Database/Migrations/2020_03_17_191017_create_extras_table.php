<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yimbo_extras', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->decimal('price', 10);
			$table->string('image')->nullable();
			$table->integer('status')->default(1);
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
        Schema::dropIfExists('yimbo_extras');
    }
}
