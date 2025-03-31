<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\RatingAndComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request, $product) {
        $request -> validate([
            'body' => 'required|string|max:500',
            'rating_value' => 'required|integer|between:1,5'
        ]);

        $comment = RatingAndComment::create([
            'user_id' => Auth::id(),
            'product_id' => $product,
            'body' => $request -> input('body'),
            'rating_value' => $request -> input('rating_value')
        ]);

        if($comment) {
            return back() -> with('status', 'Comment successful');
        }
    }
}
