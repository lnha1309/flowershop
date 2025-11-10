<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_flower_types', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('flower_type_id');
            $table->primary(['product_id', 'flower_type_id']);
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('flower_type_id')->references('flower_type_id')->on('flower_types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_flower_types');
    }
};

