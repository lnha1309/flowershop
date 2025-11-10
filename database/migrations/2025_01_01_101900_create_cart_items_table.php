<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('cart_item_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
