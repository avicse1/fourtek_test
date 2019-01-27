<?php

namespace App\Http\Middleware;

use Closure;
use App\Library\Helper;

class LoginCheck
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
        $logged_in = Helper::isUserLoggedIn();

        if(!$logged_in) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
