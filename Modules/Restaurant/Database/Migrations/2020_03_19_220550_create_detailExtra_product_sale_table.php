<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailExtraProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yimbo_detailExtra_product_sale', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('detail_extra_id');
            $table->foreign('detail_extra_id')->references('id')->on('yimbo_detail_extras');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('yimbo_products');

            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('yimbo_sales');

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
        Schema::dropIfExists('yimbo_detailExtra_product_sale');
    }
}
