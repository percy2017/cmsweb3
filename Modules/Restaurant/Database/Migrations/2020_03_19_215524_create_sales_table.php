<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yimbo_sales', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->integer('nro_tiket')->nullable();
			$table->decimal('subtotal', 10)->nullable();
			$table->decimal('descuento', 10)->nullable();
			$table->decimal('importe_base', 10)->nullable();
			$table->string('venta_tipo')->nullable();//json
            $table->string('venta_estado')->default();//json
            $table->string('tipo_pago')->default();//json
			$table->integer('nro_mesa')->nullable();
			$table->decimal('monto_recibido', 10)->nullable();
            $table->text('observaciones', 65535)->nullable();
            
            $table->unsignedBigInteger('cashe_id');
            $table->foreign('cashe_id')->references('id')->on('yimbo_cashes');//caja
            
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('yimbo_customers');//cliente

            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('yimbo_sales');
    }
}
