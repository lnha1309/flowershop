<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->increments('recipient_id');
            $table->string('recipient_name', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipients');
    }
};

