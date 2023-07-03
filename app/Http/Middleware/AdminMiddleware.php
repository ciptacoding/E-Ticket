<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the user is an admin
        if($request->user() && $request->user()->role === 'admin'){
            return $next($request);
        }

        // if the user is not an admin, return a 403 Forbidden response
        // abort(403, 'Unauthorized.');
        return redirect('/');
    }
}
