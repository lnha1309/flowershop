<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->unsignedInteger('user_id');
            $table->dateTime('order_date')->useCurrent();
            $table->string('status', 30)->default('Pending');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->unsignedInteger('payment_method_id')->nullable();
            $table->unsignedInteger('shipping_address_id')->nullable();
            $table->foreign('payment_method_id')->references('method_id')->on('payment_methods');
            $table->foreign('shipping_address_id')->references('address_id')->on('shipping_address');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
