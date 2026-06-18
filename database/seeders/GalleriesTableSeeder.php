<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample gallery images
        Gallery::create([
            'title' => 'Kegiatan Hafalan Al-Qur\'an',
            'description' => 'Foto-foto dari kegiatan hafalan Al-Qur\'an rutin yang diadakan setiap pagi hari.',
            'image_path' => 'assets/img/gallery/hafalan-quran.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Gallery::create([
            'title' => 'Upacara Hari Kebangsaan',
            'description' => 'Moment kehangatan saat merayakan hari kebangsaan bersama semua warga pesantren.',
            'image_path' => 'assets/img/gallery/upacara-kebangsaan.jpg',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Gallery::create([
            'title' => 'Kelas Bakat Angliran',
            'description' => 'Santri-santri yang mengikuti kelas bakat dalam bidang angliran dan kreativitas.',
            'image_path' => 'assets/img/gallery/kelas-bakat.jpg',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Gallery::create([
            'title' => 'Pengajian Keluarga Rutin',
            'description' => 'Pengajian keluarga yang diadakan setiap malam Jumat setelah sholat maghrib.',
            'image_path' => 'assets/img/gallery/pengajian-keluarga.jpg',
            'is_active' => true,
            'sort_order' => 4,
        ]);
    }
}