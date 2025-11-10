<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_styles', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('style_id');
            $table->primary(['product_id', 'style_id']);
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('style_id')->references('style_id')->on('styles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_styles');
    }
};

