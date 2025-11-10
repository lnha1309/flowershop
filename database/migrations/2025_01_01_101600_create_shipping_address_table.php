<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shipping_address', function (Blueprint $table) {
            $table->increments('address_id');
            $table->unsignedInteger('user_id');
            $table->string('address_detail', 200)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('recipient_name', 100)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_address');
    }
};
