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
        Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('ticket_number')->unique();
        $table->string('customer_name');
        $table->string('phone_number');
        $table->enum('category', ['kebocoran', 'air_mati', 'tagihan', 'kualitas_air', 'lainnya']);
        $table->text('description');
        $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
