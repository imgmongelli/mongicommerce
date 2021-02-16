<?php
namespace Mongi\Mongicommerce\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Models\Cart;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Redirect;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class ShopLoginController extends AuthenticatedSessionController
{
    public function page()
    {
        return view('mongicommerce.pages.login');
    }

    public function store(LoginRequest $request){
        $request->authenticate();
        $request->session()->regenerate();
        return Redirect::back()->with('message','Loggato con successo!');
    }

    public function storeAndRedirect(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        Template::MoveSessionToCart(Auth::user()->id);
        return redirect(route('shop'));
    }
}
