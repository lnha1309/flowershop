<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_themes', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('theme_id');
            $table->primary(['product_id', 'theme_id']);
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('theme_id')->references('theme_id')->on('themes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_themes');
    }
};

