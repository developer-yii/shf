<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;


class IsAdmin
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
        $user = Auth::user();
        if(isset($user->id) && ($user->role == '1' || $user->role == '2')){
        return $next($request);
        }
        return redirect()->route('admin.login')->with('error','You have not admin access. Please Login as admin');
        // $result = ['status'=> false, 'error' => 'You have not admin access. Please Login as admin'];
        // return response()->json();
    }
}
