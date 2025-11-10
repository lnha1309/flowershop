<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_recipients', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('recipient_id');
            $table->primary(['product_id', 'recipient_id']);
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('recipient_id')->references('recipient_id')->on('recipients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_recipients');
    }
};

