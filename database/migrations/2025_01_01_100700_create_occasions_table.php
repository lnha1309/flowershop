<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('occasions', function (Blueprint $table) {
            $table->increments('occasion_id');
            $table->string('occasion_name', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('occasions');
    }
};

