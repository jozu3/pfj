<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class CheckRole
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
        // if (auth()->user()->hasAnyRole(['Obispo', 'Matrimonio de apoyo'])) {
        //    return redirect()->route('admin.index');
        // }
        return $next($request);
    }
}
