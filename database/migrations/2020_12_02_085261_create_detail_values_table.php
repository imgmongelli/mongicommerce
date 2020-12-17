<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_id');
            $table->string('value');
            $table->timestamps();

            //fk
            $table->foreign('detail_id')->references('id')->on('details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_values');
    }
}
