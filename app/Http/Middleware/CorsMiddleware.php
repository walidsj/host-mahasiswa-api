<?php

/**
 * Location: /app/Http/Middleware
 */

namespace App\Http\Middleware;

use Closure;
use App\User;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorization = $request->header('Authorization');
        $key = explode(' ', $authorization);
        $origin = $_SERVER['HTTP_ORIGIN'];

        if ($key[0] == 'Bearer' && !empty($key[1])) {
            $user = User::where('api_token', $key[1])->first();
            $urlClient = explode(',', $user->hostClient);
            if (in_array($urlClient, $origin)) {
                $headers['Access-Control-Allow-Origin'] = $origin;
            } else {
                $headers['Access-Control-Allow-Origin'] = '*';
            }
        } else {
            $header['Access-Control-Allow-Origin'] = '*';
        }
        $header['Access-Control-Allow-Methods'] = 'POST, GET, OPTIONS, PUT, DELETE';
        $header['Access-Control-Allow-Credentials'] = 'true';
        $header['Access-Control-Max-Age'] = '86400';
        $header['Access-Control-Allow-Headers'] = 'Content-Type, Authorization, X-Requested-With';

        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
