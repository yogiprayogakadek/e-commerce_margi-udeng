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
        Schema::create('produk', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('kategori_id', 50);
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->string('nama',100);
            $table->string('foto', 100);
            $table->json('data')->nullable();
            $table->text('deskripsi');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
