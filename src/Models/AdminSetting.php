<?php


namespace Mongi\Mongicommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    public static function getStripeApiKey(){
        $globalSetting = self::first();
        return $globalSetting->stripe_api_key;
    }

    public static function getStripeApiSecretKey(){
        $globalSetting = self::first();
        return $globalSetting->stripe_api_secret;
    }

    public static function getIban(){
        $globalSetting = self::first();
        return $globalSetting->iban;
    }

}
