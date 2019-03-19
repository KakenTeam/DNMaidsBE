<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        header("Access-Control-Allow-Origin: https://resttesttest.com/");
        $headers = [
            "Access-Control-Allow-Methods" => "POST, GET, PUT, DELETE, OPTIONS",
            "Access-Control-Allow-Headers" => "Content-Type, X-Auth-Token, Origin, Authorization"
        ];
        if($request->getMethod() == 'OPTIONS') {
            return response()->json('OK', 200, $headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header ($key, $value);
        }
        return $response;
    }
}
