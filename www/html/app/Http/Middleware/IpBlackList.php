<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IpBlackList
{
    private const array BLACK_LIST = ['192.168.0.0'];

    public function handle(Request $request, Closure $next): Response
    {
        if (in_array($request->getClientIp(), self::BLACK_LIST, true)) {
            throw new AccessDeniedHttpException();
        }

        return $next($request);
    }
}
