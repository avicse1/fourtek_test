<?php

namespace App\Http\Middleware;

use Closure;
use App\Library\Helper;
class AdminCheck
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
        $logged_user = Helper::getCurrentUser();
        $role = $logged_user->role;
        if($role != 'admin') {
            return redirect()->back(); //block unauthorized access
        }
        return $next($request);
    }
}
