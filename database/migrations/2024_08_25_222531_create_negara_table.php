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
        Schema::create('negara', function (Blueprint $table) {
            $table->id('id_negara');
            $table->foreignId('id_direktorat')
                ->constrained('direktorat', 'id_direktorat')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('id_kawasan')
                ->constrained('kawasan', 'id_kawasan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nama_negara');
            $table->string('kode_negara');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negara');
    }
};