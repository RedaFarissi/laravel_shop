<?php

namespace App\Http\Middleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response{
        if(Auth::check()){
            $userId = Auth::user();
            $user = User::find($userId->id);
        }
        if( Auth::check() && ($user->isAdmin() || $user->isSuperAdmin()) ){
            return $next($request);
        }
        return redirect()->route('home'); 
    }
}
