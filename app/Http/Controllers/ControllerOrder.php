<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerOrder extends Controller
{
    public function order_view(){
        return view('order.order');
    }
}
