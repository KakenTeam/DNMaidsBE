<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckIfAdmin
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
        $user = User::findorfail($request->user()->id) ;

        foreach ($user->groups as $group){
            if ($group->group_name == 'Admin'
                || $group->group_name == 'admin') {
                return $next($request);
            }
        }
        return response()->json([
            'message' => 'Not Authorized!'
        ], 403);
    }
}
