<?php

namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class ControllerAdmin extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    private function check_if_user(){
        $userId = Auth::user();
        $user = User::find($userId->id);
        return ($user->isUser())?True:False;
    }

    public function admin_home(){
        $is_user = $this->check_if_user();
        return ($is_user)?redirect()-> route('home'):view('admin.index');
    }
}