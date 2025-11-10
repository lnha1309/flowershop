<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->primary();
            $table->integer('quantity_in_stock');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};

