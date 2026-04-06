<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('products', function (Blueprint $table) {
    $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
    $table->string('name');
    $table->string('brand')->nullable();
    $table->text('description')->nullable();
    $table->timestamps();

    // 🔥 biar gak duplicate dalam 1 sub category
    $table->unique(['sub_category_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
