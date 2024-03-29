<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('image')->nullable();
            $table->boolean('is_home')->default(false);
            $table->boolean('is_reserved')->default(false);
            $table->unsignedBigInteger('category_id');
            $table->boolean('single_product')->default(false);
            $table->boolean('is_gift')->default(false);
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            //foreign
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
