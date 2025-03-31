<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class Product extends Model
{


    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
    ];
    
    public function getPriceAttribute($value): string    
    {
        return Number::currency($value);
    }

    public function category() {
        return $this -> belongsTo(Category::class);
    }

    public function user() {
        return $this -> belongsTo(User::class);
    }

    public function cart() {
        return $this -> hasMany(Cart::class);
    }

    public function order() {
        return $this -> hasMany(Order::class);
    }

    public function ratingAndComment() {
        return $this -> hasMany(RatingAndComment::class);
    }
}
