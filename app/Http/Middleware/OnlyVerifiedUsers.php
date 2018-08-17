<?php

namespace App\Http\Middleware;

use Auth;
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
            Auth::logout();

            $request->session()->flash('message', 'You need to verify your account and Login again.');
            $request->session()->flash('message_status', 'brand');

            return redirect()->route('login');
        }
    }
}
