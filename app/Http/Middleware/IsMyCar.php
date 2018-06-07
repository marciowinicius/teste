<?php

namespace FederalSt\Http\Middleware;

use Closure;
use FederalSt\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IsMyCar
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
        if (Auth::check()) {
            $car_id = $request->route('id');
            $car = Car::find($car_id);
            if ($car->user_id == Auth::user()->id) {
                return $next($request);
            }

            Session::flash('flash_error', trans('message.not_authorized'));
            return redirect()->back();


        }
        return abort(404);
    }
}
