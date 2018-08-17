<?php

namespace App\Http\Middleware;

use Closure;

class OnlyVerifiedUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isVerified()) {
            return $next($request);
        } else {
            abort(403, 'You need to verify email first.');
        }
    }
}
