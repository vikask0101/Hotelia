<?php

namespace App\Http\Middleware;

use App\Enum\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->user_type === UserTypeEnum::ADMIN->value) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Access denied. Admins only.');
    }
}
