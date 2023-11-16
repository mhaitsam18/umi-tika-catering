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
        Schema::create('item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->nullable()
                ->constrained('pemesanan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('menu_id')->nullable()
                ->constrained('menu')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->integer('jumlah')->nullable();
            $table->float('harga_per_item')->nullable();
            $table->float('harga_total')->nullable();
            $table->string('testimoni')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
