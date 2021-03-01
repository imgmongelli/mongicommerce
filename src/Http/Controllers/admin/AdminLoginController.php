<?php

namespace Mongi\Mongicommerce\Http\Controllers\admin;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class AdminLoginController extends AuthenticatedSessionController
{
    public function page()
    {
        return view('mongicommerce::admin.pages.login');
    }

    public function storeAndRedirect(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect(route('admin.dashboard'));
    }
}
