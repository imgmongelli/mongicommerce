<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('shipped_date')->nullable();
            $table->decimal('total_price');
            $table->decimal('shipping_price')->default(0);
            $table->text('id_shipping')->nullable();
            $table->text('note_delivery')->nullable();
            $table->boolean('pick_up_in_shop')->default(false);
            $table->decimal('order_weight')->default(0);


            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('type_payment_id');
            $table->timestamps();

            //fk
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses_order');
            $table->foreign('type_payment_id')->references('id')->on('typesPayment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
