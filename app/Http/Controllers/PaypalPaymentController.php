<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\StripePaymentController;

class PaypalPaymentController extends Controller {
    public function handlePayment(Request $request)
    {
        $orderId = Order::latest()->first()->id;
        $order_to_pay = OrderItem::where('order_id',$orderId)->get();
        $StripePaymentController = new StripePaymentController();
        

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $StripePaymentController->totalPrice($order_to_pay,$orderId)
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('cancel.payment')->with('error', 'Something went wrong.');
        } else {
            return redirect()->route('cart_view')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel(){
        $order = Order::latest()->first();
        $orderId = $order->id;
        $order->delete();
        $orderItem = OrderItem::where('order_id',$orderId)->get();
        foreach($orderItem as $item){
            $item->delete();
        }
        return redirect()->route('payment_failed');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order = Order::latest()->first();
            $order->paid = true;
            $order->save();
            return redirect()->route('payment_success');
        } else {
            $this->paymentCancel();
            return redirect()->route('payment_failed');
        }
    }
}
