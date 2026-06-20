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
        Schema::create('santri_kelas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('santri_id');
            $table->uuid('kelas_id');
            $table->string('tahun_ajaran');
            $table->date('masuk_kelas')->nullable();
            $table->date('keluar_kelas')->nullable();
            $table->timestamps();

            $table->foreign('santri_id')->references('id')->on('santris')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->unique(['santri_id', 'kelas_id', 'tahun_ajaran']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri_kelas');
    }
};