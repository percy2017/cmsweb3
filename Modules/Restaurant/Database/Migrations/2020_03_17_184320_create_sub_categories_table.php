<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yimbo_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
			$table->text('description', 65535)->nullable();
            $table->string('slug', 191)->unique('slug');
            
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('yimbo_categories');
            
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
        Schema::dropIfExists('yimbo_sub_categories');
    }
}
