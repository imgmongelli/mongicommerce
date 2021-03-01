<?php

namespace Mongi\Mongicommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect(route('admin.login'));
        }
        // Perform action
        $user = Auth::user();

        if ($user->admin == true) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
