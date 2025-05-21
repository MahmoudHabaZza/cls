<?php

namespace App\Http\Middleware;

use App\RoleEnum;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();
        if($user && ($user->role == RoleEnum::Admin->value)){
            return $next($request);
        }

        return Response::errorResponse('Unauthorized Access',401);
    }
}
