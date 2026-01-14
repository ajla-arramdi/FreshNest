<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fruits', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();

            // Harga
            $table->decimal('price', 10, 2);

            // Unit: kg atau pcs
            $table->enum('unit', ['kg', 'pcs']);

            // Stok (kg atau pcs tergantung unit)
            $table->decimal('stock', 10, 2);

            // Berat rata-rata per buah (khusus unit pcs)
            $table->decimal('avg_weight', 5, 2)->nullable(); // dalam KG

            // Gambar
            $table->string('image')->nullable();

            // Relasi ke kategori
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fruits');
    }
};
