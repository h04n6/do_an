<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Customer
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
        if (Auth::check()) {
           $user=Auth::user();
           if ($user->role_id==User::ROLE_CUSTOMER) {
                 return $next($request);
           }
           else{
           return redirect()->route('login');
           }
        }
        else{
              return redirect()->route('login');
        }
      
    }
}
