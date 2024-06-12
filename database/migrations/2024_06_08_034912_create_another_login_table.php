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
        Schema::create('another_login', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('provider_id')->nullable();
            $table->string('provider_name')->nullable();
            $table->longText('provider_token')->nullable();
            $table->string('provider_refresh_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('another_login');
    }
};