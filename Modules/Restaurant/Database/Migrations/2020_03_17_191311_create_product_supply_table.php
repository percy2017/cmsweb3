<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSupplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_supply', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('supply_id')->unsigned();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('supply_id')->references('id')->on('supplies');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_supply');
    }
}
