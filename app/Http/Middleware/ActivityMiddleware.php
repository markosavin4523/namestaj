<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user() ? auth()->user()->email : "neulogovan";
        $date = new \DateTime();
        $data = json_encode($request->except(["_token","password","password_confirmation"]));
        $route = $request->route() ? $request->route()->getName() : $request->method()."_".$request->path();
        $route = $route ?? "nema rute";
        $query = $request->getQueryString();
        $activity = new Activity();
        $activity->user = $user;
        $activity->date = $date;
        $activity->route = $route;
        $activity->query = $query;
        $activity->data= $data;
        $activity->save();

        return $next($request);
    }
}
