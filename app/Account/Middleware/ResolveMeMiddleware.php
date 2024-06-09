<?php

namespace App\Account\Middleware;

use App\Constant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveMeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->route('userId');
        /**
         * @var string $userLoginId
         */
        $userLoginId = $request->user()?->id;

        if ($userId === Constant::ME && $userLoginId && $request->route()) {
            $request->route()->setParameter('userId', $userLoginId);
        }

        return $next($request);
    }
}
