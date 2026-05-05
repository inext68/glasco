<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckContextRole
{
    public function handle(Request $request, Closure $next, string $context, string $role)
    {
        $user = $request->user();

        if (! $user || ! $user->hasPermission($context . ':' . $role)) {
            abort(403, 'Unauthorized contextual role.');
        }

        return $next($request);
    }
}
