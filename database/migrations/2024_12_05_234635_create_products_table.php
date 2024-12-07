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
            $table->id();
        $table->unsignedBigInteger('category_id');
        $table->string('name')->unique();
        $table->decimal('purchase_price', 10, 2); // Pastikan kolom ini ada
        $table->decimal('sale_price', 10, 2); // Kolom ini juga
        $table->integer('stock');
        $table->string('image')->nullable();
        $table->timestamps();

        // Relasi dengan tabel categories
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
