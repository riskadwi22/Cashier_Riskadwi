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
        Schema::create('detail_transacts', function (Blueprint $table) {
            $table->id();

            // Perbaikan di sini
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('sellings')->onDelete('cascade');

            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transacts');
    }
};
