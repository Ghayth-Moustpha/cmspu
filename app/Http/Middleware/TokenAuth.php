<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        
        $user = Auth::guard('sanctum')->user();

        if ($user === null) {
            throw new UnauthorizedException('Unauthorized access.');
        }

        $request->merge(['user' => $user]);

        return $next($request);
    }
}
