<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerCart extends Controller{
    public function card_views(){
        return view('cart.carts');
    }
}
