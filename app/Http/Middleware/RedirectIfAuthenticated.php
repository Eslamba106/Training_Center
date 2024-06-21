<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //write code for redirect both for admin or front in case login alerady done
                if ($request->is('admin') || $request->is('admin/*')) {
                //redirect Backend student
                    return redirect(RouteServiceProvider::ADMIN);

                } 
                elseif($request->is('student') || $request->is('student/*')) {
                    return redirect(RouteServiceProvider::student);
                }
                elseif($request->is('moderator') || $request->is('moderator/*')) {
                    return redirect(RouteServiceProvider::Moderator);
                }
            }
        }

        return $next($request);
    }
}
