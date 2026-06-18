<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $beritaCategory = Category::where('slug', 'berita')->first();
        $kegiatanCategory = Category::where('slug', 'kegiatan')->first();
        $pendidikanCategory = Category::where('slug', 'pendidikan')->first();

        // Create sample posts
        Post::create([
            'title' => 'Selamat Tahun Baru 2026',
            'slug' => 'selamat-tahun-baru-2026',
            'excerpt' => 'Pesantren Exemplar mengucapkan selamat tahun baru 2026 kepada seluruh warga pesantren dan społeczitas luas.',
            'content' => '<p>Dalam rangka memasuki tahun baru 2026, Pesantren Exemplar mengucapkan selamat tahun baru yang penuh berkah kepada seluruh santri, ustadz, staf, dan wali santri. Kami berharap tahun ini merupakan tahun yang lebih baik bagi kita semua dalam mencari ilmu dan amal saleh.</p><p>Mohon doa restu untuk terus bisa memberikan pendidikan yang berkualitas berbasis nilai-nilai keislaman.</p>',
            'status' => 'published',
            'published_at' => Carbon::parse('2026-01-01 08:00:00'),
            'category_id' => $beritaCategory ? $beritaCategory->id : null,
            'featured_image' => null,
            'meta_title' => 'Selamat Tahun Baru 2026 - Pesantren Exemplar',
            'meta_description' => 'Pesantren Exemplar mengucapkan selamat tahun baru 2026',
        ]);

        Post::create([
            'title' => 'Penerimaan Santri Baru Tahun Pelajaran 2026/2027 Dibuka',
            'slug' => 'penerimaan-santri-baru-2026-2027',
            'excerpt' => 'Pendaftaran santri baru untuk tahun pelajaran 2026/2027 telah resmi dibuka mulai tanggal 1 Juli 2026.',
            'content' => '<p>Pesantren Exemplar proudly announces that registration for new students for the 2026/2027 academic year is now open. Prospective students and their parents can visit our website or come directly to the pesantren office to obtain registration forms and information.</p><p>Requirements include: good conduct, sound mental and physical health, age appropriate for the educational level, and interest in Islamic education.</p>',
            'status' => 'published',
            'published_at' => Carbon::parse('2026-06-15 10:00:00'),
            'category_id' => $beritaCategory ? $beritaCategory->id : null,
            'featured_image' => null,
            'meta_title' => 'Penerimaan Santri Baru 2026/2027 - Pesantren Exemplar',
            'meta_description' => 'Pendaftaran santri baru untuk tahun pelajaran 2026/2027 telah dibuka',
        ]);

        Post::create([
            'title' => 'Tips Menghafal Al-Qur\'an dengan Efektif',
            'slug' => 'tips-menghafal-al-quran-efektif',
            'excerpt' => 'Berikut beberapa tips efektif untuk menghafal Al-Qur\'an yang dapat Anda praktekkan setiap hari.',
            'content' => '<p>Menghafal Al-Qur\'an adalah ibadah yang mulia yang membutuhkan komitmen dan strategi yang tepat. Berikut beberapa tips yang dapat membantu Anda dalam menghafal Al-Qur\'an dengan lebih efektif:</p><ol><li>Niat yang ikhlas</li><li>Jadwal hafalan yang konsisten</li><li>Mengulang hafalan setiap hari</li><li>Memahami arti apa yang dihafalkah</li><li>Berdoa sebelum dan setelah hafalan</li></ol><p>Dengan konsentrasi dan niat yang baik, InsyaAllah Anda akan bisa menghafal Al-Qur\'an dengan lebih mudah.</p>',
            'status' => 'published',
            'published_at' => Carbon::parse('2026-06-10 14:30:00'),
            'category_id' => $pendidikanCategory ? $pendidikanCategory->id : null,
            'featured_image' => null,
            'meta_title' => 'Tips Menghafal Al-Qur\'an dengan Efektif - Pesantren Exemplar',
            'meta_description' => 'Tips efektif untuk menghafal Al-Qur\'an',
        ]);
    }
}