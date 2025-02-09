<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return $this->unauthorized('Token not provided');
        }

        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException) {
            return $this->unauthorized('Token has expired');
        } catch (TokenInvalidException) {
            return $this->unauthorized('Invalid token');
        } catch (JWTException) {
            return $this->unauthorized('Token is required');
        } catch (Exception) {
            return $this->unauthorized('Unauthorized');
        }

        return $next($request);
    }

    private function unauthorized(string $message)
    {
        \Log::error("Unauthorized: " . $message);  // 🔍 Debugging Log
        return response()->json(['error' => $message], Response::HTTP_UNAUTHORIZED);
    }
}
