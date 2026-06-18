<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default categories
        Category::create([
            'name' => 'Berita',
            'slug' => 'berita',
            'description' => 'Berita dan pengumuman terbaru dari pesantren',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Kegiatan',
            'slug' => 'kegiatan',
            'description' => 'Informasi tentang kegiatan yang ada di pesantren',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Pendidikan',
            'slug' => 'pendidikan',
            'description' => 'Artikel tentang pesantren dan kurikulum Islam',
            'is_active' => true,
        ]);
    }
}