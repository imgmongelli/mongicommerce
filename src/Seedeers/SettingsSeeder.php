<?php


namespace Mongi\Mongicommerce\Seedeers;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mongi\Mongicommerce\Models\AdminSetting;
use Mongi\Mongicommerce\Options\DetailTypes;

class SettingsSeeder extends Seeder
{
     public function run(){
        $settings = new AdminSetting();
        $settings->shop_name = 'MongiCommerce';
        $settings->iban = 'DE79100110012626219557';
        $settings->email = 'gianluca.mongelli@gmail.com';
        $settings->minimum_shop = '50';
        $settings->stripe_api_key = 'pk_test_gm6oybWPRbK7A3btf0CgwmRv';
        $settings->stripe_api_secret = 'sk_test_F6whJE7SznVkEI0aPxeo97b3';
        $settings->share_capital = '10000';
        $settings->address = 'Via monsignor Laera, Acquaviva delle fonti, 214, Italia';
        $settings->currency = '€';
        $settings->telephone = '3240537258';
        $settings->claim_email = 'gianluca.mongelli@gmail.com';
        $settings->piva = '12345678901';
        $settings->free_delivery = 100;
        $settings->min_delivery = 7;
        $settings->is_by_weight = false;
        $settings->delivery_less_5 = 7;
        $settings->delivery_less_10 = 11.50;
        $settings->delivery_less_20 = 16.50;
        $settings->delivery_less_30 = 21.50;
        $settings->delivery_less_50 = 25;
        $settings->save();
     }
}
