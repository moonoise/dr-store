<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    private $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->auth =
            auth()->user() ?
                (auth()->user()->role === 'admin')
                :false ;

        if ($this->auth === true)
            return $next($request);
        return redirect()->route('login')->with('error','Access denided. Login to continue.');

    }
}
