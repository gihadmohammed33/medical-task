<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // If you prefer redirect instead of 403:
        // return redirect()->route('dashboard')->with('error','Unauthorized');

        abort(403, 'Unauthorized.');
    }
}
