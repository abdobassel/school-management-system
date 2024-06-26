<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'student':
                if (auth()->guard($guard)->check()) {
                    return redirect(RouteServiceProvider::STUDENT);
                }
                break;
            case 'teacher':
                if (auth()->guard($guard)->check()) {
                    return redirect(RouteServiceProvider::TEACHER);
                }
                break;
            case 'parent':
                if (auth()->guard($guard)->check()) {
                    return redirect(RouteServiceProvider::PARENT);
                }
                break;
            default:
                if (auth()->guard($guard)->check()) {
                    return redirect(RouteServiceProvider::HOME);
                }
                break;
        }

        return $next($request);
    }
}
