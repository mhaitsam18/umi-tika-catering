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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu')->nullable();
            $table->enum('waktu_makan', ['breakfast','lunch', 'dinner'])->nullable();
            $table->date('tanggal')->nullable();
            $table->foreignId('paket_id')->nullable()
                ->constrained('paket')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
