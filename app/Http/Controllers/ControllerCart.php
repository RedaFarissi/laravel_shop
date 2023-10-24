<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ControllerCart extends Controller{

    public function cart_view(Request $request) {
        $session = $request->session();
        $carts = $session->get('cart', []);
        //dd($carts , count($carts));
        return view('cart.carts' , ["carts"=>$carts]);
    }

    public function cart_add(Request $request, $product_id ) {
        $request->validate([
            'quantity' => 'required|integer', 
        ]);
        $session = $request->session();
        $products = $session->get('cart', []);
        
        $product = Product::find($product_id);
        // check if product all ready exist in cart
       
        foreach($products as $item){
            if($item->id == $product->id){
                $item->quantity = $request->input('quantity');
                $session->put('cart', $products);
                return redirect()->route('cart_view');
                break;
            }
        }

        //add quantity to product
        $product->quantity = $request->input('quantity');
        
        // Add the product to the list of products.
        $products[count($products)] = $product;
        $session->put('cart', $products);

        

        return redirect()->route('cart_view');
    }

    public function cart_clear(){
        $request = request();
        $session = $request->session();
        $session->flush();
        return redirect()->route('cart_view');
    }
}
