<?php

namespace App\Http\Middleware;

use Closure;

class SubjectTeacherMiddleware
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
        if(auth()->check() && $request->user()->typ_id == 4 || $request->user()->typ_id == 1){
            return $next($request);
        }
        else if(auth()->check() && $request->user()->typ_id == 1){
            return redirect()->guest('/admin/dashboard');
        }
        else if(auth()->check() && $request->user()->typ_id == 2){
            return redirect()->guest('/adviser/dashboard');
        }
        else if(auth()->check() && $request->user()->typ_id == 3){
            return redirect()->guest('/student/dashboard');
        }
        else if(auth()->check() && $request->user()->typ_id == 5){
            return redirect()->guest('/panel/dashboard');
        }
        else if(auth()->check() && $request->user()->typ_id == 6){
            return redirect()->guest('/adviser/dashboard');
        }
        else{
            return redirect()->guest('/');
        }
    }
}
