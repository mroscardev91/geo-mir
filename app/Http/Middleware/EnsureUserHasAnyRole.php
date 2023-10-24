<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasAnyRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array($request->user()->role_id, $roles)) {
            $url = $request->url();
            return redirect('dashboard')
                ->with('error', "Access denied to {$url}");
        }

        return $next($request);
    }
}
