<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 50)->nullable();
			/**
            --------------------------------------------
            ELEGIR QUE ATRIBUTO PARA CREAR EL DATA ROWS
            --------------------------------------------
			$table->text('observaciones', 65535)->nullable();
			$table->date('fecha_apertura')->nullable();
			$table->time('hora_apertura')->nullable();
			$table->date('fecha_cierre')->nullable();
			$table->time('hora_cierre')->nullable();
			$table->decimal('monto_inicial', 10)->nullable();
			$table->decimal('monto_final', 10)->nullable();
			$table->decimal('monto_real', 10)->nullable();
			$table->decimal('monto_faltante', 10)->nullable();
			$table->decimal('total_ingresos', 10)->nullable();
			$table->decimal('total_egresos', 10)->nullable();
            $table->integer('abierta')->nullable();

            */
            
			$table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('branch_office_id');
            $table->foreign('branch_office_id')->references('id')->on('branch_offices');//sucursal
            

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
        Schema::dropIfExists('cashes');
    }
}
