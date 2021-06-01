<?php

namespace Modules\Users\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $admin = auth()->guard('api')->user();

        if ($admin->is_admin) {
            return $next($request);

        }

        return response('UNAUTHORIZED', 403);
    }
}
