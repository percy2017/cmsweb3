<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_product', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('extra_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->timestamps();

            $table->foreign('extra_id')->references('id')->on('extras');
            $table->foreign('product_id')->references('id')->on('products');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_product');
    }
}
