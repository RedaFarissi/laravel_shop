<?php
      
namespace App\Http\Controllers;
       
use Illuminate\Http\Request;
use Stripe;
       
class StripePaymentController extends Controller
{
    public function payment_view(){
        return view("payment.index");   
    }  

    public function stripePost(Request $request) {

        $session = $request->session();
        $carts = $session->get('cart', []);
        $total_price = 0 ;
        
        foreach($carts as $cart) $total_price += $cart['price'] * $cart['quantity'] ;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
        Stripe\Charge::create ([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
        return view("contact.success");   
    }
}