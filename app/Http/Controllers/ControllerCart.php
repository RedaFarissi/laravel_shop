<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ControllerCart extends Controller{

    public function cart_view(Request $request) {
        $session = $request->session();
        $carts = $session->get('cart', []);
        
        if(count($carts) === 0){
            return redirect()->route('cart_empty');
        }

        $total_price = 0 ;
        foreach($carts as $cart) $total_price += $cart['price'] * $cart['quantity'] ;
       
        return view('cart.carts' , [ 
            "carts"=>$carts , 
            "total_price"=>$total_price 
        ]);
    }

    
    public function cart_add(Request $request, $product_id ) {
        $session = $request->session();
        $request->validate([
            'quantity' => 'required|integer', 
        ]);
        $products = $session->get('cart', []);
        $product = Product::findOrFail($product_id);
        // Check if the product already exists in the cart
        $productIndex = -1;
        foreach($products as $index => $item){
            if($item['id'] == $product->id){
                $productIndex = $index;
                break;
            }
        }
        if ($productIndex >= 0) {
            // Update quantity if product exist in cart
            $products[$productIndex]['quantity'] = $request->input('quantity');
        } else {
            $product->quantity = $request->input('quantity');
            $products[count($products)] = $product;
        }
        $session->put('cart', $products);
        $cart = session('cart');
        return redirect()->route('cart_view');
    }

    public function delete_cart_id(Request $request, $cart_id) {
        $session = $request->session();
        $carts = $session->get('cart', []);
        // Use array_filter to remove the matching cart by $cart_id
        $carts = array_filter($carts, function ($cart) use ($cart_id) {
            return $cart['id'] != $cart_id;
        });
        $session->put('cart', $carts);
    
        return redirect()->route('cart_view');
    }
    
    public function cart_clear(){
        $request = request();
        $session = $request->session();
        $session->flush();
        return redirect()->route('cart_view');
    }

    public function cart_empty(){
        return view('cart.empty');
    }
}
