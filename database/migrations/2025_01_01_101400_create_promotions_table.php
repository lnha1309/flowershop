<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('promotion_id');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->decimal('discount_percent', 4, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};

