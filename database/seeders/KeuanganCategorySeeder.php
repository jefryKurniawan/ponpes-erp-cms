<?php

namespace Database\Seeders;

use App\Models\KeuanganCategory;
use Illuminate\Database\Seeder;

class KeuanganCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            // Pemasukan
            ['nama' => 'SPP', 'tipe' => 'pemasukan', 'icon' => 'receipt', 'warna' => 'emerald-500', 'keterangan' => 'Sumbangan Pembinaan Pendidikan'],
            ['nama' => 'Donasi', 'tipe' => 'pemasukan', 'icon' => 'donate', 'warna' => 'green-600', 'keterangan' => 'Donasi dari warga atau alumni'],
            ['nama' => 'Pengembalian', 'tipe' => 'pemasukan', 'icon' => 'undo', 'warna' => 'yellow-500', 'keterangan' => 'Pengembalian pembiayaan atau kas'],
            // Pengeluaran
            ['nama' => 'Gaji Guru', 'tipe' => 'pengeluaran', 'icon' => 'person', 'warna' => 'blue-600', 'keterangan' => 'Pembayaran gaji guru dan staf'],
            ['nama' => 'Listrik', 'tipe' => 'pengeluaran', 'icon' => 'bolt', 'warna' => 'yellow-400', 'keterangan' => 'Tagihan listrik bulanan'],
            ['nama' => 'Air', 'tipe' => 'pengeluaran', 'icon' => 'drop', 'warna' => 'blue-400', 'keterangan' => 'Tagihan air'],
            ['nama' => 'Makanan', 'tipe' => 'pengeluaran', 'icon' => 'restaurant', 'warna' => 'orange-500', 'keterangan' => 'Beli bahan makanan untuk dapur'],
            ['nama' => 'Transportasi', 'tipe' => 'pengeluaran', 'icon' => 'directions_car', 'warna' => 'red-500', 'keterangan' => 'BBM dan kendaraan'],
            ['nama' => 'Perlengkapan Kantor', 'tipe' => 'pengeluaran', 'icon' => 'folder', 'warna' => 'purple-500', 'keterangan' => 'Alat tulis dan perlengkapan administrasi'],
            ['nama' => 'Kebersihan', 'tipe' => 'pengeluaran', 'icon' => 'clean_hands', 'warna' => 'teal-500', 'keterangan' => 'Produk kebersihan dan sanitasi'],
        ];

        foreach ($categories as $cat) {
            KeuanganCategory::updateOrCreate(['nama' => $cat['nama']], $cat);
        }
    }
}