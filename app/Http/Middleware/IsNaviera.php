<?php

namespace App\Http\Middleware;

use Closure;

class IsNaviera
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
        if ($request->user()->id_tipo_usuario != 2)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
