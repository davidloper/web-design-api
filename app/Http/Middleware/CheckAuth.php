<?php

namespace App\Http\Middleware;

use App\AuthSession;
use Closure;

class CheckAuth
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
        $auth_session = AuthSession::where('token',$request->token)->first();

        info($auth_session->expires_at);
        
        if($auth_session 
            &&
         $auth_session->expires_at->lt(now())
        ){  
            $auth_session->expires_at = now()->addMinutes(5);
            $auth_session->save();
            return $next($request);
        }
        else{
            if($auth_session)$auth_session->delete();
            response()->json('',401,['Access-Control-Allow-Origin' => config('constants.allowedOrigin')])->send();
            exit;
        }
    }
}
