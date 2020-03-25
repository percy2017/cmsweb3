<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*
            --------------------------------------------
            ELEGIR QUE ATRIBUTO PARA CREAR EL DATA ROWS
            --------------------------------------------
            $table->text('concepto', 65535)->nullable();
			$table->decimal('monto', 10)->nullable();
			$table->string('tipo', 20)->nullable();
			$table->date('fecha')->nullable();
			$table->time('hora')->nullable();
            */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');//usuario

            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales');//ventas

            $table->unsignedBigInteger('cashe_id');
            $table->foreign('cashe_id')->references('id')->on('cashes');//cajas

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
        Schema::dropIfExists('seats');
    }
}
