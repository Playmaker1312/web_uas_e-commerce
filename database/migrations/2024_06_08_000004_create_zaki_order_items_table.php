<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zaki_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('zaki_orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('zaki_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zaki_order_items');
    }
}; 