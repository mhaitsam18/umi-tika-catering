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
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->nullable()
                ->constrained('item')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('member_id')->nullable()
                ->constrained('member')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('testimoni')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};
