<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;
use App\Models\RatingAndComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllPageController extends Controller
{
    public function homePage(Request $request) {
        $query = $request -> input('search');
        // dd($query);
        if ($query) {
            $allProduct = Product::with('category') // Eager load the category
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%'); // Search by product name
                })
                ->orWhereHas('category', function($q) use ($query) {
                    $q->where('category', 'like', '%' . $query . '%');
                })
                ->paginate(8)->withQueryString();
            
            // dd($allProduct); // Debugging output
        } else {
            $allProduct = Product::with('category')->get(); 
        }

        return view('frontend.home', [
            'allProduct' => $allProduct,
            'query' => $query,
        ]);
    }

    public function becomeAsellerPage() {
        return view('frontend.seller');
;    }

    public function helpAndSupportPage() {
        return view('frontend/help');
    }

    public function cartPage() {
        return view('frontend.cart');
    }

    public function profile() {
        $orders = Order::where('user_id', Auth::id()) -> get();
        $products = Product::with('category')->where('user_id', Auth::id()) -> get();
        return view('main.profile', compact('orders', 'products'));
    }

    public function editProduct() {
        return view('main.editProduct');
    }

    public function showSelectedProduct($id) {
        $product = Product::with('user') -> find($id);

        $rate = RatingAndComment::select('rating_value') -> get();
        if($rate -> count() > 0) {
            $ratingValue = RatingAndComment::where('product_id', $id)->avg('rating_value');
        } else {
            $ratingValue = 0;
        }
        
        $products = RatingAndComment::with('user')
        ->where('product_id', $id)
        ->paginate(4);
        return view('main.selectedProduct', ['product' => $product, 'comment' => $products, 'rating' => $ratingValue]);
    }


    public function showOrder($id) {
        $order = Order::where('id', $id)->get();

        foreach ($order as $key) {
            $json = json_decode($key->products);
        }

        $products = [];
        foreach ($json as $value) {
            $product = Product::find($value->product_id);
            if ($product) {
                 $products[] = [
                    'product' => $product,
                    'quantity' => $value->quantity,
                ];
            }
        }
        
        return view('main.order', [
            'order' => $order,
            'products' => $products,
        ]);
    }

}
