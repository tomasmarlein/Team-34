<?php


namespace App\Http\Middleware;

use Closure;


class Verantwoordelijke
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->rolId==+3) {
            return $next($request);
        }
        return abort(403, 'toegang geweigerd');
    }
}
