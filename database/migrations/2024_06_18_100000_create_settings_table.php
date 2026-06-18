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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // pesantren, history, vision_mission, psb_info, psb_form, etc.
            $table->string('nama_pesantren')->nullable();
            $table->string('tahun_berdiri')->nullable();
            $table->string('pendiri')->nullable();
            $table->text('isi')->nullable();
            $table->text('isi_misi')->nullable();
            $table->string('tanggal_buka')->nullable();
            $table->string('tanggal_tutup')->nullable();
            $table->string('tanggal_seleksi_akademik')->nullable();
            $table->string('tanggal_pengumuman')->nullable();
            $table->decimal('biaya_pendaftaran', 15, 2)->nullable()->default(0);
            $table->decimal('biaya_spp', 15, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

