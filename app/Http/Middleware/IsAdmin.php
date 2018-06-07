<?php

namespace FederalSt\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {


            if (Auth::user()->role == 2) {


                return $next($request);


            }

            Session::flash('flash_error', trans('message.not_authorized'));
            return redirect()->back();


        }


        return abort(404);
    }
}
