<?php

namespace  App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


class ControllerAdmin extends Controller{
    public function __construct(){
        $this->middleware('admin');
    }
    public function admin_home(){
        return view('admin.index');
    }
}