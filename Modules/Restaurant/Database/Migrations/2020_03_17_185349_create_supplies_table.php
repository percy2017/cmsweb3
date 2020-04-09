<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yimbo_supplies', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->string('unity')->nullable();
            $table->decimal('price', 10)->nullable();
            
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
        Schema::dropIfExists('yimbo_supplies');
    }
}
