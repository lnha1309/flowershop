<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_occasions', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('occasion_id');
            $table->primary(['product_id', 'occasion_id']);
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('occasion_id')->references('occasion_id')->on('occasions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_occasions');
    }
};

