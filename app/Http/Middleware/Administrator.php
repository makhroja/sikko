<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->role == 'Administrator') {
            return $next($request);
        }

        return response()->json(['error' => 'Anda tidak dapat mengakses halaman ini'], 403);
    }
}
