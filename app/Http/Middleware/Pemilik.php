<?php

namespace App\Http\Middleware;

use Closure;

class Pemilik
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
        if (\Auth::user()->role == 'Pemilik') {
            return $next($request);
        }

        return response()->json(['error' => 'Anda tidak dapat mengakses halaman ini'], 403);
    }
}
