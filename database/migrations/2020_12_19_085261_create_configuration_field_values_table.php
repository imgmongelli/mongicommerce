<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_field_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('configuration_field_id');
            $table->string('value');
            $table->timestamps();

            //fk
            $table->foreign('configuration_field_id')->references('id')->on('configuration_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuration_field_values');
    }
}
