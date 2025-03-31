<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->nullable();  // PayPal transaction ID or other payment ID
            $table->decimal('total_amount', 10, 2);  // Total price for the order
            $table->enum('status', ['pending', 'paid', 'shipped', 'delivered', 'canceled'])->default('pending');  // Order status
            $table->json('products'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
