<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{

    public function checkout() {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => session('total')  // Replace with dynamic cart total
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success'),
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('cart')->with('error', 'Something went wrong.');
        }
    }

    public function paymentSuccess(Request $request) {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Get the cart details
            $cart = Cart::with('product')->where('user_id', Auth::id())->get();
            
            // Prepare product details for the order
            $products = [];
            foreach ($cart as $item) {
                $products[] = [
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ];
            }

            // Create the order in the orders table
            $order = Order::create([
                'user_id' => Auth::id(),
                'transaction_id' => $response['id'], 
                'total_amount' => session('total'),
                'status' => 'paid',  
                'products' => json_encode($products), 
            ]);
            session() -> forget('total');
            session()->forget('cart_count');
            // Clear the cart after the order is created
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('home')->with('success', 'Payment successful and order created!');
        } else {
            return redirect()->route('cart')->with('error', 'Payment failed.');
        }
    }

    public function paymentCancel() {
        return redirect()->route('cart')->with('error', 'Payment was canceled.');
    }   
}
