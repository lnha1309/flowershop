<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->increments('wishlist_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->timestamp('added_at')->useCurrent();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->unique(['user_id', 'product_id']);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
