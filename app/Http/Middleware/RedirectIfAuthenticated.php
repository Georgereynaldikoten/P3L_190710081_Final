<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        $roles = Role::all();
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                foreach ($roles as $role) 
                {
                    if(auth()->user()->level == $role->role_name)
                        return redirect($role->redirect_to);
                    elseif(auth()->user()->level == 'member')
                        return redirect('/BerandaMember');
                    elseif(auth()->user()->level == 'instructure')
                        return redirect('/BerandaInstructure');
                }
            }
        }

        return $next($request);
    }
}
