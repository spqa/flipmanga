<?php

namespace App\Http\Middleware;

use Closure;

class CountryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if (strcmp(config('app.env'), 'production') == 0) {
//            if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
//                if (strcmp($_SERVER["HTTP_CF_IPCOUNTRY"], 'VN') == 0) {
//                    return $next($request);
//                } else {
//                    abort(522);
//                }
//            }
//
//        }
        return $next($request);
    }
}
