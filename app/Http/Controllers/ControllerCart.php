<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerCart extends Controller{
    public function cart_view(){
        return view('cart.carts');
    }
}
