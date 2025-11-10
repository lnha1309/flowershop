<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_tracking', function (Blueprint $table) {
            $table->increments('tracking_id');
            $table->unsignedInteger('order_id');
            $table->string('status', 30);
            $table->text('description')->nullable();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_tracking');
    }
};

