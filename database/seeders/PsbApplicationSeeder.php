<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PsbApplication;

class PsbApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample PSB applications
        PsbApplication::create([
            'nama_lengkap'   => 'Ahmad Fauzi',
            'tempat_lahir'   => 'Bandung',
            'tanggal_lahir'  => '2008-05-14',
            'jenis_kelamin'  => 'Laki-laki',
            'alamat'         => 'Jl. Cihampelas No. 45, Bandung',
            'no_telepon'     => '081234567890',
            'email'          => 'ahmad.fauzi@example.com',
            'asal_sekolah'   => 'SMP Negeri 1 Bandung',
            'nama_wali'      => 'Siti Rahayu',
            'pekerjaan_wali' => 'Guru',
            'no_telepon_wali'=> '081298765430',
        ]);

        PsbApplication::create([
            'nama_lengkap'   => 'Siti Aisyah',
            'tempat_lahir'   => 'Surabaya',
            'tanggal_lahir'  => '2007-09-22',
            'jenis_kelamin'  => 'Perempuan',
            'alamat'         => 'Jl. Basuki Rahmat No. 12, Surabaya',
            'no_telepon'     => '081234567891',
            'email'          => 'siti.aisyah@example.com',
            'asal_sekolah'   => 'SMP Negeri 2 Surabaya',
            'nama_wali'      => 'Budi Santoso',
            'pekerjaan_wali' => 'Wiraswasta',
            'no_telepon_wali'=> '081298765431',
        ]);

        PsbApplication::create([
            'nama_lengkap'   => 'Muhammad Yusuf',
            'tempat_lahir'   => 'Yogyakarta',
            'tanggal_lahir'  => '2008-01-30',
            'jenis_kelamin'  => 'Laki-laki',
            'alamat'         => 'Jl. Malioboro No. 78, Yogyakarta',
            'no_telepon'     => '081234567892',
            'email'          => 'yusuf@example.com',
            'asal_sekolah'   => 'SMP Negeri 3 Yogyakarta',
            'nama_wali'      => 'Aminah',
            'pekerjaan_wali' => 'Pegawai Negeri',
            'no_telepon_wali'=> '081298765432',
        ]);
    }
}
