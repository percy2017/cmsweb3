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
        Schema::create('yimbo_branchOffice_supply', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('branch_office_id')->unsigned();
            $table->foreign('branch_office_id')->references('id')->on('yimbo_branch_offices');

            $table->bigInteger('supply_id')->unsigned();
            $table->foreign('supply_id')->references('id')->on('yimbo_supplies');

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
        Schema::dropIfExists('yimbo_branchOffice_supply');
    }
}
