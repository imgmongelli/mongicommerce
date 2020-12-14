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
            $table->longText('long_description')->nullable();
            $table->decimal('price');
            $table->text('image_path');
            $table->text('big_image_path');
            $table->integer('ml')->nullable();
            $table->decimal('alcholic')->nullable();
            $table->integer('quantity');
            $table->decimal('weight')->nullable();
            $table->boolean('in_home')->default(false);
            $table->unsignedBigInteger('category_id');
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
