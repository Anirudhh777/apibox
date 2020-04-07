<?php

namespace App\Http\Middleware;


use Closure;
use Log;
use DB;
use App\User;

class ApiAuth 
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
        if(User::where('api_token', $request->api_token)->exists()){
            return $next($request);
        }

        return response()->json([
            'status' => 401,
            'message' => "Invalid API Token"
        ]);
    }
}
