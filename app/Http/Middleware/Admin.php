<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user = Auth::user();
        $esAdmin = (boolean)$user->isAdmin;
        if($esAdmin === true){
            return $next($request);
        }
        else{
            return redirect('home');
        }
       
    }
}
