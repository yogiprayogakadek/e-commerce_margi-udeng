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
        Schema::create('detail_order', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('order_id', 50);
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->string('produk_id', 50);
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
            $table->string('size', 10);
            $table->integer('kuantitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_order');
    }
};
