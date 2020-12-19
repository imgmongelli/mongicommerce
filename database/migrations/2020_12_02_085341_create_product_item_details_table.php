<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_item_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_item_id');
            $table->unsignedBigInteger('product_detail_id');
            $table->unsignedBigInteger('product_detail_value_id');

            $table->timestamps();

            //foreign
            $table->foreign('product_item_id')->references('id')->on('product_items');
            $table->foreign('product_detail_id')->references('id')->on('details');
            $table->foreign('product_detail_value_id')->references('id')->on('detail_values');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_item_details');
    }
}
