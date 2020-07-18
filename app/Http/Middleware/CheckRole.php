<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $id)
    {
        dd($request);

        $user = Auth::user();

        if ($user->Role->RolesPermissions[$id]->value == 1) {
            return $next($request);
        } else {
            abort(403, 'Access denied');
        }
        
        return redirect('/admin/dashboard');
    }
}
