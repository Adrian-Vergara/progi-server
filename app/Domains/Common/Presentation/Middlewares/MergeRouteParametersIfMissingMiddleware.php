<?php

declare(strict_types=1);

namespace App\Domains\Common\Presentation\Middlewares;

use Closure;
use Illuminate\Http\Request;

class MergeRouteParametersIfMissingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (null !== $request->route()?->parameters) {
            $request->mergeIfMissing($request->route()->parameters);
        }

        return $next($request);
    }
}
