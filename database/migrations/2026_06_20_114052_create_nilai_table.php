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
        Schema::create('nilai', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('santri_id');
            $table->uuid('mapel_id');
            $table->decimal('nilai', 5, 2);
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('santri_id')->references('id')->on('santris')->onDelete('cascade');
            $table->foreign('mapel_id')->references('id')->on('mapel')->onDelete('cascade');
            $table->unique(['santri_id', 'mapel_id', 'semester', 'tahun_ajaran']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};