<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchOfficeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yimbo_branchOffice_product', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('branch_office_id'); //sucurasl
            $table->foreign('branch_office_id')->references('id')->on('yimbo_branch_offices');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('yimbo_products');

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
        Schema::dropIfExists('yimbo_branchOffice_product');
    }
}
