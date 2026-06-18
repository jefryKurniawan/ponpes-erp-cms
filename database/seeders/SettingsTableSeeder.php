<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pesantren profile settings
        Setting::create([
            'type' => 'pesantren',
            'nama_pesantren' => 'Pesantren Exemplar',
            'tahun_berdiri' => '2000',
            'pendiri' => 'Khai Yusuf Ahmad',
        ]);

        // History
        Setting::create([
            'type' => 'history',
            'isi' => '<p>Pesantren Exemplar didirikan pada tahun 2000 oleh Kyai Yusuf Ahmad dengan visi menciptakan generasi muda yang berilmu, berakhlak, dan kompeten dalam menghadapi tantangan zaman modern. Dimulai dari sebuah pondok kecil dengan beberapa puluhan santri, kini Pesantren Exemplar telah tumbuh menjadi lembaga Pendidikan Islam yang terkemuka dengan fasilitas lengkap dan kurikulum yang pesat.</p><p>Selama lebih dari dua dekade beroperasi, Pesantren Exemplar telah menghasilkanulusan yang tidak hanya menguasai ilmu religius tetapi juga berprestasi dalam bidang akademik dan sosial. Komitmen kami pada pendidikan berbasis nilai-nilai keislaman tetap menjadi landasan dalam setiap langkah yang kami ambil.</p>',
        ]);

        // Vision and Mission
        Setting::create([
            'type' => 'vision_mission',
            'isi' => '<p>Menjadi pesantren unggul yang menghasilkan generasi yang beriman, berlaku baik, berilmu, dan berguna untuk negara dan masyarakat.</p>',
            'isi_misi' => '<p>Menyediakan pendidikan Islam yang berkesimbangan antara ilmu religius dan ilmu sekular, mengembangkan potensi santri secara holistik melalui pembinaan espiritual, intelektual, dan sosial, serta menyiapkan santri untuk menjadi pemimpin dan pelopor perubahan yang positif dalam masyarakat.</p>',
        ]);

        // PSB Info
        Setting::create([
            'type' => 'psb_info',
            'isi' => '<p>Penerimaan Santri Baru (PSB) Pesantren Exemplar untuk tahun pelajaran 2026/2027 kini terbuka. Kami menyambut calon santri dari berbagai latar belakang yang memiliki niat yang ikhlas untuk membelajar ilmu Islam dan mengembangkan diri sesuai dengan ajaran yang tengah.</p>',
            'tanggal_buka' => '2026-07-01',
            'tanggal_tutup' => '2026-08-31',
            'tanggal_seleksi_akademik' => '2026-09-05',
            'tanggal_pengumuman' => '2026-09-20',
            'biaya_pendaftaran' => 500000,
            'biaya_spp' => 300000,
        ]);

        // PSB Form (if needed for any specific form instructions)
        Setting::create([
            'type' => 'psb_form',
            'isi' => '<p>Silakan lengkapi formulir pendaftaran dengan data yang lengkap dan Benar. Pastikan Anda telah menyiapkan semua dokumen yang diperlukan sebelum mengisi formulir ini.</p>',
        ]);
    }
}