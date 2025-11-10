<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->increments('review_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            // Optional check constraint if supported by the DB
            // $table->check('`rating` BETWEEN 1 AND 5');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
