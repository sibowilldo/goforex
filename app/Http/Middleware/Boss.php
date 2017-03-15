<?php

namespace App\Http\Middleware;

use Closure;

class Boss
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
        if (!$request->user()->hasRole('admin')) {
            flash('403 Forbidden', 'error');
            return redirect('/home');
        }

        return $next($request);
    }
}
