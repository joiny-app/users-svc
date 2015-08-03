<?php

namespace App\Http\Middleware;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Closure;

class GetAuthenticatedUserMiddleware
{
    /**
     * Get the token and verify the user`s permission
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['User not found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['Expired token'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['Invalid token'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['Token is absent'], $e->getStatusCode());
        }
        return $next($request);
    }
}
