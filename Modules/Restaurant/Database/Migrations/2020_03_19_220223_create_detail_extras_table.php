<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_extras', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*
            --------------------------------------------
            ELEGIR QUE ATRIBUTO PARA CREAR EL DATA ROWS
            --------------------------------------------
			$table->decimal('precio', 10)->nullable();
			$table->decimal('cantidad', 10)->nullable();
			$table->integer('producto_adicional')->nullable();
            $table->text('observaciones', 65535)->nullable();
            */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            
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
        Schema::dropIfExists('detail_extras');
    }
}
