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
            $table->string('name'); // Product name
            $table->string('price'); // Price in rupiah, can be ranged (e.g., "10000-20000")
            $table->decimal('price_discount', 8, 2)->nullable(); // Price Discount
            $table->integer('available'); // Available quantity
            $table->string('image_thumbnail')->nullable(); // Image Thumbnail
            $table->json('images')->nullable(); // Multiple images
            $table->text('description')->nullable(); // Description
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Related to User
            $table->foreignId('shop_id')->constrained()->onDelete('cascade'); // Related to Shop
            $table->timestamps();
        });

        // Pivot table for products and orders
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Related to Order
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Related to Product
            $table->integer('quantity'); // Quantity of the product in the order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('products');
    }
};
