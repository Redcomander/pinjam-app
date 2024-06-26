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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Related to User
            $table->foreignId('shop_id')->constrained()->onDelete('cascade'); // Related to Shop
            $table->decimal('total_price', 8, 2); // Total price of the order
            $table->string('status')->default('pending'); // Status of the order
            $table->integer('duration'); // Duration of the order in days
            $table->string('snap_token')->nullable(); // Status of the order
            $table->string('progress')->nullable(); // Progress of the order (nullable)
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
