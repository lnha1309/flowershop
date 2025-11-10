<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('size', 50)->nullable();
            $table->string('wrapping', 100)->nullable();
            $table->text('care')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('image_url', 255)->nullable();
            $table->boolean('is_visible')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

