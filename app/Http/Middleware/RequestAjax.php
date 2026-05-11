<?php

namespace App\Http\Middleware;

use Closure;

class RequestAjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->ajax()){

            return $next($request);
        }
        return abort(404);
    }
}
