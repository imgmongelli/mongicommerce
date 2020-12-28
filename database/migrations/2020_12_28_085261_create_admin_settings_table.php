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
            $table->string('shop_name')->default('MongiCommerce');
            $table->string('iban')->default('DE79100110012626219557');
            $table->string('email')->default('gianluca.mongelli@gmail.com');
            $table->string('minimum_shop')->default('50');
            $table->string('stripe_api_key')->default('pk_test_gm6oybWPRbK7A3btf0CgwmRv');
            $table->string('stripe_api_secret')->default('sk_test_F6whJE7SznVkEI0aPxeo97b3');
            $table->string('share_capital')->default('10000');
            $table->string('address')->default('Via monsignor Laera, Acquaviva delle fonti, 214, Italia');
            $table->string('currency')->default('€');
            $table->string('telephone')->default('3240537258');
            $table->string('claim_email')->default('gianluca.mongelli@gmail.com');
            $table->string('piva')->default('12345678901');
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
        Schema::dropIfExists('admin_settings');
    }
}
