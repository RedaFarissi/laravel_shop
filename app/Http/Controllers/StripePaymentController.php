<?php
      
namespace App\Http\Controllers;
       
use Illuminate\Http\Request;
use Stripe;
use App\Models\Order;
use App\Models\OrderItem;
       

class StripePaymentController extends Controller{
    public function totalPrice($order_to_pay,$orderId){
        $total_price = 0;
        foreach($order_to_pay as $item){
            $total_price += $item->price * $item->quantity;
        }
        return $total_price;
    }

    public function stripePost(Request $request) {
        $order = Order::latest()->first();
        $order_to_pay = OrderItem::where('order_id',$order->id)->get();
       
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
        Stripe\Charge::create ([
                "amount" => $this->totalPrice($order_to_pay,$order->id) * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
        
        $order->paid = true;
        $order->save();

        return redirect()->route('payment_success');   
    }

    // handle views
    public function payment_view(){
        $orderId = Order::latest()->first()->id;
        $order_to_pay = OrderItem::where('order_id',$orderId)->get();

        return view("payment.index" , [
            "order_to_pays"=> $order_to_pay , 
            "total_price"=>$this->totalPrice($order_to_pay,$orderId)
        ]);   
    }  
    public function payment_success(){
        $order = Order::latest()->first();
        $order->paid = true;
        $order->save();
        return view("payment.success");
    }
    public function payment_failed(){
        return view("payment.failed");
    }
}
