<?php

namespace Mongi\Mongicommerce\Http\Controllers\termsAndPrivacy;

use Mongi\Mongicommerce\Models\Setting;

class TermsPrivacyController
{
    public function termsConditions(){
        $settings = Setting::first();
        return view('mongicommerce.pages.terms_conditions', compact('settings'));
    }

    public function cookiePolicy(){
        $settings = Setting::first();
        return view('mongicommerce.pages.cookie_policy', compact('settings'));
    }
}
