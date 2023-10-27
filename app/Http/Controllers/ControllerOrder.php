<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\ControllerCart;

class ControllerOrder extends Controller{
    public function order_view(Request $request){
        $session = $request->session();
        $carts = $session->get('cart', []);
        $total_price = 0 ;
        
        foreach($carts as $cart) $total_price += $cart['price'] * $cart['quantity'] ;
       
        return view('order.order' ,[ 
            "total_price"=>$total_price 
        ]);
    }
    public function order_store(Request $request){
        $session = $request->session();
        $carts = $session->get('cart', []);
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string', 
            'email' => 'required|string', 
            'address' => 'required|string', 
            'postal_code' => 'required|string', 
            'city' => 'required|string',
        ]);
        $order = new Order();
        $order->first_name = strip_tags($request->input('first_name')) ; 
        $order->last_name =  strip_tags($request->input('last_name'))  ; 
        $order->email = strip_tags($request->input('email')) ; 
        $order->address = strip_tags($request->input('address'))  ; 
        $order->postal_code = strip_tags($request->input('postal_code')); 
        $order->city = strip_tags($request->input('city')); 
        $order->paid = false ; 
        $order->save();

        foreach($carts as $cart){
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->product_id = $cart->id ;
            $order_item->price = $cart->price ;
            $order_item->quantity = $cart->quantity;
            $order_item->save();
        }
        $controllerCart = new ControllerCart();
        $controllerCart->cart_clear();
        return redirect()->route('order_view');
    }
}
