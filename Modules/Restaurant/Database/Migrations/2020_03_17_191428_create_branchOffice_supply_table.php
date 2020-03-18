<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchOfficeSupplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchOffice_supply', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('branch_office_id')->unsigned();
            $table->bigInteger('supply_id')->unsigned();

            $table->timestamps();

            $table->foreign('branch_office_id')->references('id')->on('branch_offices');
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
        Schema::dropIfExists('branchOffice_supply');
    }
}
