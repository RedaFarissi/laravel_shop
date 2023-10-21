<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ControllerCart extends Controller{
    public function cart_view(){
        return view('cart.carts');
    }

    public function cart_add(Request $request, $product_id) {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $product = Product::find($product_id);
        // Cart::create([
        //     'quantity' => $request->input('quantity'),
        // ]);
        return redirect()->route('cart_view');
    }
}
