<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yimbo_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
			$table->text('description_small', 65535)->nullable();
			$table->text('description_long', 65535)->nullable();
			$table->decimal('price_sale', 10)->nullable();
			$table->decimal('price_minimum', 10)->nullable();
			$table->decimal('Last_Price_Buy', 10)->nullable();
            $table->decimal('stock', 10)->nullable()->default(0.00);
            $table->decimal('stock_minimum', 10)->nullable()->default(0.00);            
            $table->integer('it_storage')->nullable();
			$table->string('images')->nullable();
			$table->integer('views')->default(0);
            $table->string('slug', 191)->unique('slug');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('yimbo_categories');

            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('yimbo_sub_categories');
            
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
        Schema::dropIfExists('yimbo_products');
    }
}
