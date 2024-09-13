<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CelebrateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect(route('home'));
        }
        $user = auth()->user();
        $canGo = cache()->get($user->id . '_celebrate');
        if (!$canGo) {
            return redirect(route('home'));
        }
        return $next($request);
    }
}
