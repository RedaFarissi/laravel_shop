<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware { 
    public function handle(Request $request, Closure $next): Response {
        if(Auth::check()){
            $userId = Auth::user();
            $user = User::find($userId->id);
        }
        if( Auth::check() &&  $user->isSuperAdmin() ){
            return $next($request);
        }elseif( Auth::check() &&  $user->isAdmin() ){
            return redirect()->route('admin_home'); 
        }else{
            return redirect()->route('home'); 
        }
    }
}