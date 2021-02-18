<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('email')->nullable();
            $table->string('minimum_shop')->nullable();
            $table->string('stripe_api_key')->nullable();
            $table->string('stripe_api_secret')->nullable();
            $table->string('share_capital')->nullable();
            $table->string('address')->nullable();
            $table->string('currency')->nullable();
            $table->string('telephone')->nullable();
            $table->string('claim_email')->nullable();
            $table->string('piva')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_settings');
    }
}
