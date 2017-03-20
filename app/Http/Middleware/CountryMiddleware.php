<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

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
        $country_code=['CN','JP','KR'];
        if (in_array(Request::server('HTTP_CF_IPCOUNTRY'),$country_code)){
            abort('522');
        }
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
