<?php

namespace App\Http\Middleware;

use Closure;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->profile_id=="me" || $request->profile_id == null)
        {
            if(Admin::user()->isRole('pegawai')){
                $request->profile_id=578;
                return $next($request);
            }   
            $request->profile_id=578;
            return $next($request);
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
