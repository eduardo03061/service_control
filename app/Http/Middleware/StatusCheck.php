<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class StatusCheck
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->status != 1) {
            Auth::logout();
            $errorMsj = "No tienes permisos para acceder";
            return back()->with('errorMsj', $errorMsj);
        }
        return $next($request);
    }
}
