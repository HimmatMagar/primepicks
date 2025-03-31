<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    protected $casts = [
        'products' => 'array',  // Automatically cast JSON to an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this -> belongsTo(Product::class);
    }

}
