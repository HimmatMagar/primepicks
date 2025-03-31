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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table -> string('name', 50);
            $table -> longText('description');
            $table -> bigInteger('price');
            $table -> integer('stock');
            $table -> string('image', 50);
            $table -> foreignId('user_id') -> references('id') -> on('users') -> onDelete('cascade');
            $table -> foreignId('category_id') -> references('id') -> on('categories') -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
