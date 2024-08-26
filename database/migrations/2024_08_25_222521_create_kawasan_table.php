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
        Schema::create('kawasan', function (Blueprint $table) {
            $table->id('id_kawasan');
            $table->foreignId('id_direktorat')
                ->constrained('direktorat', 'id_direktorat')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nama_kawasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kawasan');
    }
};