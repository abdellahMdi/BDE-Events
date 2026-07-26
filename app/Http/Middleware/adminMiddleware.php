<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\EventController;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403, 'You must be logged in to view this page.');
        }

        if ($user->role->label != 'admin') {
            abort(403, 'Access denied. Admins only.');
        }

        return $next($request);
    }
}