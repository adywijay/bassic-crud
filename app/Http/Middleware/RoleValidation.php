<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RoleValidation
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, $next)
    {
        if (Session::get('role_id') != 1 || Session::get('status') != 'Active') {
            return redirect('internals-sys/login')->with('error', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}