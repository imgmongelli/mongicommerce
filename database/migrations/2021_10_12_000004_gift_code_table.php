<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GiftCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_code', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_item_id')->nullable();
            $table->string('code')->unique();
            $table->boolean('is_validated')->default(false);
            $table->integer('duration')->nullable();
            $table->timestamp('bought_the')->nullable();
            $table->timestamp('expires_on')->nullable();

            $table->timestamps();

            //foreign
            $table->foreign('product_item_id')->references('id')->on('product_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_code');
    }
}
