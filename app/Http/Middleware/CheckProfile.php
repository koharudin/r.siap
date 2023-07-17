<?php

namespace App\Http\Middleware;

use App\Models\Employee;
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
                $nip = Auth::user()->username;
                $e = Employee::where('nip_baru',$nip)->get()->first();
                $request->profile_id=$e->id;
                return $next($request);
            }   
            return $next($request);
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
