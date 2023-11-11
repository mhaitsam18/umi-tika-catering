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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()
                ->constrained('member')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->decimal('diskon')->nullable();
            $table->float('total_harga')->nullable();
            $table->float('harga_diskon')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['proses', 'selesai', 'batal'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
