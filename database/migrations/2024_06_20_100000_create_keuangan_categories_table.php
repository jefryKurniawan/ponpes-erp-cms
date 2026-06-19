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
        Schema::create('keuangan_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama')->unique(); // e.g., 'Sumbangan', 'SPP', 'Donasi', 'Operasional'
            $table->enum('tipe', ['pemasukan', 'pengeluaran'])->default('pemasukan');
            $table->string('icon')->nullable(); // For UI purposes
            $table->string('warna')->nullable(); // For UI purposes
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Insert default categories
        DB::table('keuangan_categories')->insert([
            [
                'id' => '11111111-1111-1111-1111-111111111111',
                'nama' => 'Sumbangan',
                'tipe' => 'pemasukan',
                'icon' => 'fa-heart',
                'warna' => '#28A745',
                'keterangan' => 'Sumbangan dari wali santri atau donatur',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '22222222-2222-2222-2222-222222222222',
                'nama' => 'SPP',
                'tipe' => 'pemasukan',
                'icon' => 'fa-graduation-cap',
                'warna' => '#0E9467',
                'keterangan' => 'Sumbangan Pembinaan Pendidikan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '33333333-3333-3333-3333-333333333333',
                'nama' => 'Operasional',
                'tipe' => 'pengeluaran',
                'icon' => 'fa-cogs',
                'warna' => '#DC3545',
                'keterangan' => 'Biaya operasional harian',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '44444444-4444-4444-4444-444444444444',
                'nama' => 'Gaji Honorer',
                'tipe' => 'pengeluaran',
                'icon' => 'fa-user-tie',
                'warna' => '#FFC107',
                'keterangan' => 'Pembayaran gaji staf dan guru',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_categories');
    }
};