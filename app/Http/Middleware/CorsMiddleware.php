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

        if (!empty($authorization)) {
            $key = explode(' ', $authorization);
            if ($key[0] == 'Bearer' && !empty($key[1])) {
                $user = User::where('api_token', $key[1])->first();
                $headers = [
                    'Access-Control-Allow-Origin'      => $user->hostClient,
                    'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
                    'Access-Control-Allow-Credentials' => 'true',
                    'Access-Control-Max-Age'           => '86400',
                    'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
                ];
            }
        } else {
            $headers = [
                'Access-Control-Allow-Origin'      => '*',
                'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Max-Age'           => '86400',
                'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
            ];
        }

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
