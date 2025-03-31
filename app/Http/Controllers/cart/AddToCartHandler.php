<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class AddToCartHandler extends Controller
{
    public $total = 0;
    public function addProduct(Request $request, $postId) {
        Cart::create([
            'product_id' => $postId,
            'user_id' => Auth::id(),
            'quantity' => $request -> input('index'),
        ]);
        $count = Cart::count();
        session(['cart_count' => $count]);
        return back() -> with('status', 'Product added to cart.');
        // dd($request -> all(), $postId);
    }
    public function showCartProduct() {
        $subTotal = 0;
        $shippingFee = 10;
        $this -> total = 0;
        $tt = [];
        $cart = Cart::with('product') -> where('user_id', Auth::id()) -> whereDate('created_at', Carbon::today()) -> get();

        #Retrive The Value
        foreach ($cart as $key) {
            $tt[] = (int) str_replace([',', '$'], '', $key -> product -> price);
            $quantity[] = $key -> quantity;
        }
       
        #calculate Total Price
        foreach ($tt as $key => $price) {
           $subTotal += $price * $quantity[$key];
        }

        $this -> total = $subTotal + $shippingFee;
        session(['total' => $this -> total]);
        return view('frontend.cart', [
            'cart' => $cart,
            'subTotal' => $subTotal,
            'total' => $this -> total
        ]);
    }

    public function removeProduct($id) {
        Cart::destroy($id);
        session() -> decrement('cart_count', 1);
        return back() -> with('status', 'Product removed from cart.');
    }
}
