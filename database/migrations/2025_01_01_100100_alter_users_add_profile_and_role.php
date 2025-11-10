<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Recreate the users table to match provided SQL exactly
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('full_name', 100)->nullable();
            $table->string('gender', 5)->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedInteger('role_id')->nullable();
            $table->foreign('role_id')->references('role_id')->on('roles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
