<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsGoogle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_google == 0) {
            return $next($request);
        }

        return back()->with('error', 'Unauthorized Page!');
    }
}
