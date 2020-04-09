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
        Schema::create('yimbo_extra_product', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('extra_id')->unsigned();
            $table->foreign('extra_id')->references('id')->on('yimbo_extras');

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('yimbo_products');

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
        Schema::dropIfExists('yimbo_extra_product');
    }
}
