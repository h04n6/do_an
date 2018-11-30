<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Admin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $current_route = $request->route()->getName();
        if (!is_null(Auth::user())) {
            if (!in_array(Auth::user()->role_id, User::ROLE_ADMIN)) {
                abort(403);
            } else {
                if (Auth::user()->role_id <> User::ROLE_SUPERADMIN) {
                    if (!in_array($current_route, Auth::user()->role->route())) {
                        abort(403);
                    }
                }
                return $next($request);
            }
        } else {
            return redirect()->route('login');
        }
    }

}
