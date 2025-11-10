<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->increments('style_id');
            $table->string('style_name', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('styles');
    }
};

