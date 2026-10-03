<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadOnlyDemo
{
    public function handle(Request $request, Closure $next): Response
    {
        if (config('demo.enabled') && $request->is(
            'admin/*', 'category/*', 'product/*', 'user/*',
            'cart', 'cart/*', 'checkout', 'checkout/*', 'orders/*',
            'login', 'register', 'home', 'password/*', 'email/*', 'verification/*'
        )) {
            abort(404);
        }

        if (config('demo.enabled') && !$request->isMethodSafe()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'This is a read-only demo.'], 403)
                : response('This is a read-only demo. No data was changed.', 403);
        }

        return $next($request);
    }
}
