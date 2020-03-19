<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
			$table->text('address', 65535)->nullable();
			$table->string('phone')->nullable();
			$table->string('whtasapp')->nullable();
			$table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            
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
        Schema::dropIfExists('branch_offices');
    }
}
