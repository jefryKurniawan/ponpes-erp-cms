# Dokumen Kebutuhan Produk: Sistem Pesantren ERP-CMS (Fullstack)

## 1. Ringkasan Eksekutif

**Pernyataan Masalah**: 
- Frontend CMS Pesantren saat ini belum terlihat modern ("jadul") dan tidak dioptimalkan untuk pengguna mobile, meskipun banyak komunitas pesantren mengakses informasi terutama melalui perangkat seluler karena keterbatasan ketersediaan laptop.
- Panel admin (ERP) masih mengandalkan proses manual atau sistem terpisah untuk keuangan, inventaris, dan manajemen santri, causing inefficiency and data silos.
- Tidak ada landing page yang menarik yang menjelaskan visi, misi, dan unggulan pesantren bagi pengunjung pertama kali.

**Solusi yang Diusulkan**: 
Bangun sistem fullstack berbasis Laravel yang terdiri dari:
1. **Frontend CMS Publik** yang responsif dan mobile-first dengan performa >95 Lighthouse.
2. **Panel Admin ERP** yang modular untuk keuangan, inventaris, manajemen santri, pengguna, dan laporan.
3. **Landing Page** yang menampilkan profil pesantren, gallery highlight, dan call-to-action untuk PSB atau kontak.
Semua komponen menggunakan stack teknologi yang sama, berbasis database terpadu, dan dioptimalkan untuk lingkungan hosting terbatas.

**Kriteria Keberhasilan**:
- Skor performa Lighthouse ≥95 untuk mobile dan desktop (frontend CMS)
- Waktu muat halaman <3 detik pada koneksi 3G yang disimulasikan (frontend CMS)
- Pengalaman pengguna yang dioptimalkan untuk mobile dengan antarmuka yang ramah sentuh (frontend CMS & admin)
- Nol referensi rusak ke atribusi eksternal (Muhammad Iqbal/dibaliqaja diganti dengan branding CMS Pesantren)
- Semua halaman CMS (home, tentang, berita, PSB, galeri) berfungsi penuh dan responsif
- Implementasi tema mengikuti estetika organis/alam dengan elemen Indonesi tradisional:
  - Warna primer: #0E9467 (biru tua - terinspirasi dari batik)
  - Warna sekunder: #8B4513 (terakota - tone bumi hangat)
  - Warna aksen: #D4AF37 (krim/emas - untuk highlight)
  - Tipografi: Kalam untuk header, Lora untuk teks utama
  - Skor aksesibilitas Lighthouse minimal 90%
- Panel admin ERP mampu mengelola:
  - Transaksi keuangan (pemasukan, pengeluaran, saldo)
  - Data santri lengkap (biometri, riwayat, kelulusan)
  - Inventaris barang (perlengkapan, konsumsi, peminjaman)
  - Pengguna dan peran (admin, bendahara, wali santri dengan akses terbatas)
  - Laporan bulanan dan tahunan yang dapat diunduh (PDF/Excel)
- Landing page menyajikan:
  - Visi, misi, dan profil singkat pesantren
  - Slider gambar kegiatan terbaru
  - Tombol CTA untuk info PSB, kontak, atau donasi
  - Integrasi dengan feed berita CMS terbaru
- Semua form (PSB, transaksi, dll.) dilindungi oleh CSRF dan validated server-side
- Tidak ada data sensitif yang ditampilkan secara publik tanpa izin
- Pencegahan XSS dan SQL injection menggunakan fitur Laravel bawaan
- **Penggunaan Heroicons**: Set ikon Blade resmi Laravel digunakan konsisten di seluruh UI (frontend CMS dan panel admin) untuk memastikan visual yang harmonius dan ringan.

## 2. Pengalaman Pengguna & Fungsionalitas

**Persona Pengguna**:
1. **Wali Santri (Orang Tua/Pengasuh)**: Orang tua siswaprospektif yang mengakses melalui smartphone untuk mencari informasi pesantren, melihat program, dan mengajukan permohonan PSB.
2. **Umum/Publik**: Anggota komunitas, alumni, dan pihak yang tertarik yang mengakses berita, acara, dan konten galeri melalui mobile.
3. **Admin Pesantren (Bendahara/Staf Keuangan)**: Mengelola transaksi keuangan, inventaris, dan laporan keuangan.
4. **Admin Akademik (Kurusai/Wali Kelas)**: Mengelola data santri, nilai, dan kehadiran.
5. **Superadmin**: Mengelola pengguna, peran, pengaturan sistem, dan cadangan data.
6. **Pengunjung Pertama (Landing Page)**: Calon wali santri atau donor yang membutuhkan informasi cepat tentang pesantren sebelum memutuskan untuk mendaftar atau berkontribusi.

**Cerita Pengguna**:

*Sebagai Wali Santri, saya ingin dengan mudah menemukan informasi pesantren dan mengajukan permohonan PSB pada perangkat seluler saya sehingga saya dapat membuat keputusan yang tepat tentang pendidikan anak saya tanpa perlu laptop.*
- Kriteria Penerimaan:
  - Formulir PSB dapat diakses dalam 2 ketukan dari halaman utama pada mobile
  - Kolom formulir dioptimalkan untuk input sentuh (area yang dapat disentuh minimal 48x48pt)
  - Validasi real-time dengan pesan kesalahan yang jelas
  - Halaman konfirmasi pengiriman dengan langkah selanjutnya
  - Formulir berfungsi pada perangkat Android berspesifikasi rendah (Android 8.0+)
  - Desain visual menggunakan tema organik/alami dengan palet warna batik yang diinspirasi (#0E9467, #8B4513, #D4AF37)
  - Header menggunakan font Kalam, teks utama menggunakan font Lora untuk penampilan tradisional namun mudah terbaca

*Sebagai anggota publik, saya ingin dengan cepat mengakses berita, acara, dan konten galeri pada perangkat seluler saya sehingga saya dapat tetap informasi mengenai kegiatan pesantren.*
- Kriteria Penerimaan:
  - Daftar berita dimuat dalam <2 detik pada koneksi 3G
  - Gambar galeri dimuat dengan tulisan perlengkapan (lazy-load) dengan placeholder thumbnail
  - Fungsi pencarian/filter mengembalikan hasil dalam 1 detik
  - Konten dapat dibaca tanpa perlu zoom (font dasar minimal 16px)
  - Semua gambar memiliki teks alternatif yang sesuai untuk aksesibilitas
  - Desain mengadopsi tata letak asimetrik dengan spasi putih yang luas sesuai estetika organik/alami
  - Pola geometris kustom yang diturunkan dari seni Islam digunakan sebagai tekstur latar belakang halus
  - Batas dekoratif yang diinspirasi dari ukiran kayu tradisional digunakan pada kartu dan kontainer
  - Animasi hover halus dan mikro-interaksi memberikan umpan balik tanpa mengorbankan performa

*Sebagai admin pesantren (bendahara), saya ingin mencatat pemasukan dan pengeluaran harian serta menghasilkan laporan bulanan sehingga saya dapat secara akurat melaporkan keuangan kepad pengurus.*
- Kriteria Penerimaan:
  - Formulir transaksi keuangan mudah diakses dari dashboard
  - Validasi jumlah harus numerik dan tidak boleh negatif untuk pemasukan (kecuali pengembalian)
  - Riwayat transaksi dapat di_filter berdasarkan tanggal, jenis (masuk/keluar), dan kategori
  - Export laporan ke PDF/Excel dengan satu klik
  - Dashboard menunjukkan saldo kas terkini dan grafik tren 6 bulan terakhir
  - Otorisasi: hanya pengguna dengan peran bendahara atau superadmin yang dapat mengakses modul keuangan

*Sebagai admin akademik, saya ingin mengelola data santri lengkap (identitas, orang tua, riwayat pendidikan) sehingga saya dapat memantau perkembangan dan kelulusan santri.*
- Kriteria Penerimaan:
  - Formulir santri mencakup: nama, tempat/tanggal lahir, jeniskelamin, alamat, no telepon, asal sekolah, nama ayah/ibu, pekerjaan orang tua, dll.
  - Upload foto santri dengan validasi tipe file (jpg/png) dan ukuran maks 2MB
  - Data santri dapat di_cari berdasarkan nama, NISN, atau tahun masuk
  - Riwayat kelas dan nilai dapat ditambahkan dan dilihat dalam satu tampilan
  - Otorisasi: hanya guru, kurasai, atau superadmin

*Sebagai superadmin, saya ingin mengelola pengguna dan peran serta mengatur pengaturan sistem agar setiap modul berjalan dengan aman dan sesuai kebutuhan lintas departemen.*
- Kriteria Penerimaan:
  - Manajemen pengguna: membuat, mengedit, menghapus akun; reset password
  - Manajemen peran: memetakan izin (keuangan, akademik, inventaris) kepada peran
  - Pengaturan sistem: mengubah nama pesantren, tahun berdiri, logo, kontak, dan preferensi notifikasi
  - Log aktivitas mencatat semua pengguna dan perubahan kritis
  - Cadangan database dapat dijalankan manual atau terjadwal (hari Minggu jam 02:00)

*Selaku pengunjung pertama, saya ingin landing page yang menarik memberikan gambaran jelas tentang pesantren dalam kurang dari 10 detik sehingga saya tertarik untuk mengeksplorasi lebih lanjut atau menghubungi pihak terkait.*
- Kriteria Penerimaan:
  - Header dengan logo pesantren, nama, dan tagline (visi singkat)
  - Hero section dengan slideshow 3-5 gambar kegiatan terkait (hafalan, upacara, kelas)
  - Tombol CTA jelas: "Info PSB", "Lihat Galeri", "Hubungi Kami"
  - Seksi singkat tentang visi, misi, dan unggulan (prestasi akademik, kegiatan ekstrakurikuler)
  - Feed berita terbaru (3 item terakhir) dengan judul dan tanggal
  - Footer dengan alamat, nomor telepon, media sosial ikon, dan hak cipta
  - Semua elemen responsif dan memenuhi kriteria aksesibilitas minimum WCAG AA

**Tujuan Non-Utama**:
- Kami SEDANG membangunkan aplikasi seluler (native atau hybrid) untuk zukünftig
- Kami SEDANG membuka kemampuan e-commerce atau pemrosesan pembayaran untuk donasi atau pembayaran SPP
- Kami SEDANG membuat akun pengguna untuk pengunjung CMS publik (komentar berita, dll.)
- Kami SEDANG mengintegrasikan dengan feed media sosial pihak ketiga untuk auto-publish kegiatan
- Kami SEDANG menambahkan modul inventaris yang mencakup peminjaman alat (proyektor, sound system) dan barang konsumsi (beras, minyak)

## 3. Spesifikasi Teknis

**Gambaran Umum Arsitektur**:
Sistem mengikuti pola MVC Laravel dengan templating Blade untuk kedua sisi (frontend CMS dan panel admin). 
- **Frontend Publik**: Jalur didefinisikan di `routes/cms.php` (di luar middleware otentikasi).  
- **Panel Admin**: Jalur didefinisikan di `routes/web.php` (dengan middleware `auth` dan role-based).  
- **API**: Jalur di `routes/api.php` (middleware `auth:api`) untuk konsumsi oleh aplikasi seluler atau integrasi masa depan.  
- **Controller**: 
  - `App\Http\Controllers\Web\Cms\WelcomeController` untuk semua logika frontend.  
  - `App\Http\Controllers\Web\[NamaModul]Controller` untuk modul admin (Contoh: `KeuanganController`, `SantriController`, `InventarisController`).  
  - `App\Http\Controllers\Api\[NamaModul]Controller` untuk endpoint API.  
- **Model**: Model Eloquent untuk setiap entitas (Setting, Post, Category, Gallery, Santri, Keuangan, Inventaris, User, Role, dll.).  
- **Aset**:
  - CSS/JS Frontend: `public/assets/css/cms/` dan `public/assets/js/cms/`
  - CSS/JS Admin: `public/assets/css/admin/` dan `public/assets/js/admin/`
  - Semua menggunakan variabel CSS tema (`--primary`, `--secondary`, `--accent`, `--light`, `--dark`) agar konsisten.
- **Database**: Tabel untuk settings, posts, categories, galleries, santris, keuangan_transaksi, inventaris_barang, inventaris_kategori, users, roles, role_users, logs, dll. (lihat migrasi)
- **Aliran Data**: Database → Model Eloquent → Controller → Blade View → HTML/CSS/JS Responsif (frontend) atau PHP/Blade + JS (admin).

**Detail Implementasi Tema (selaras di kedua sisi)**:
- **Variabel CSS**: Didefinisikan di `public/assets/css/cms/main.css` dan diimpor juga oleh aset admin melalui `@import` atau variabel global.
  ```css
  :root {
    --primary: #0E9467;      /* Biru tua - inspirasi batik */
    --secondary: #8B4513;    /* Terakota - tone bumi hangat */
    --accent: #D4AF37;       /* Krim/emas - untuk highlight */
    --light: #F8F9FA;        /* Latar belakang terang */
    --dark: #212529;         /* Teks gelap */
  }
  ```
- **Tipografi**: 
  - Header (h1-h3): Font-family: 'Kalam', kursif
  - Teks utama: Font-family: 'Lora', serif
  - Google Fonts dengan tumpukan fallback
- **Prinsip Tata Letak** (frontend & admin):
  - Tata letak asimetrik dengan elemen yang tumpang tindih bila sesuai
  - Spasi putih yang luas (minimal 1.5rem padding)
  - Elemen yang memecah grid untuk minat visual
  - Overlay tekstur halus menyerupai kain benang/batik (<5% opacity)
- **Gerakan & Interaksi**:
  - Animasi hover: transisi 200ms ease-in-out
  - Ungkapan bertahap saat gulir menggunakan IntersectionObserver (delay 50ms antar elemen)
  - Mikro-interaksi: efek menekan tombol, status fokus kolom formulir
  - Kursor kustom terinspirasi pena kaligrafi (opsional)
  - **Micro Frontend / Interaksi Setiap Elemen Setiap elemen frontend (tombol, kartus, form input, foto, dll.) harus dilengkapi dengan micro-interaksi atau animasi halus yang memberikan umpan balik visual tanpa menurunkan performa Lighthouse di bawah 95.** Semua animasi menggunakan CSS transition/animation dengan durasi ≤200ms dan mengandalkan GPU‑accelerated properties (transform, opacity) untuk menjaga 60fps.
- **Styled Komponen** (digunakan di Blade melalui class utility atau komponen Blade):
  - Kartus: `border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);`
  - Tombol Primer: bg--primary text-white
  - Tombol Sekunder: bg--secondary text-white
  - Tombol Tolak: border--primary text--primary bg-transparent hover:bg--primary/10
  - Gambar: rounded 0.375rem dengan bayangan halus
  - Pembagi: 1px solid var(--secondary) opacity-10
  - Form Input: border border--gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring--primary/20
  - Tabel: border-collapse; w-full; text-left

**Poin Integrasi**:
- **Routing**:
  - `/routes/cms.php` – publik (tanpa auth)
  - `/routes/web.php` – admin (dengan middleware `auth` + `role:`)
  - `/routes/api.php` – API (dengan middleware `auth:api`)
- **Kontroller**:
  - Frontend: `App\Http\Controllers\Web\Cms\WelcomeController` (index, about, newsIndex, newsShow, psb, psbForm, psbSubmit, psbThankYou, gallery)
  - Admin – Keuangan: `App\Http\Controllers\Web\KeuanganController` (index, create, store, show, edit, update, destroy, laporan)
  - Admin – Santri: sudah ada `SantriController` (lengkap)
  - Admin – Inventaris: `App\Http\Controllers\Web\InventarisController`
  - Admin – Pengguna & Role: `App\Http\Controllers\Web\UserController` dan `RoleController`
  - API – Contoh: `App\Http\Controllers\Api\KeuanganController` (index laporan)
- **Model**: Eloquent models di `app/Models` masing-masing sesuai tabel.
- **Tampilan**: Blade templates di:
  - `resources/views/cms/` (frontend)
  - `resources/views/admin/keuangan/`, `admin/santri/`, `admin/inventaris/`, `admin/pengguna/`, `admin/roles/`, `layouts/admin.app`
- **Aset**:
  - CSS: `public/assets/css/cms/main.css` + `components.css` (frontend); `public/assets/css/admin/app.css` (admin)
  - JS: `public/assets/js/cms/main.js` (frontend); `public/assets/js/admin/app.js` (admin) – interaksi tabel, modal, AJAX
  - **Ikon**: Heroicons (set ikon Blade resmi Laravel) digunakan konsisten di seluruh UI (frontend CMS dan panel admin) untuk memastikan visual yang harmonius dan ringan.
- **Database**: Tabel diinisialisasi melalui migrasi dan diisi dengan seeder realistik (lihat database/seeders)

**Keamanan & Privasi**:
- Semua pengiriman formulir meliputi perlindungan CSRF (Laravel built-in)
- Setiap form (PSB, transaksi keuangan, inventaris, dll.) menggunakan Form Request untuk validasi sisi server
- Data pribadi disimpan dengan standar Laravel (hashing password,enkripsi sensitif bila perlu)
- Tidak ada data sensitif ditampilkan tanpa izin (mis. nomor rekening, detail gaji hanya untuk bendahara+superadmin)
- Pencegahan XSS: Blade otomatis escapes `{{ }}`; gunaka `{!! !!}` hanya bila diperlukan dan sudah disaring
- Pencegahan SQL injection: Eloquent/query builder menggunakan parameter binding
- File upload: divalidasi MIME type & ukuran, disimpan di storage/public dengan nama acak, diakses melalui url storage link
- Implementasi tema tidak memperkenalkan kerentanan (CSS/JS standar)
- API menggunakan token sanctum atau laravel passport (untuk ke depannya); saat ini hanya untuk internal
- Log aktivitas: setiap perubahan kritis (transaksi, user.role) dicatat menggunakan `App\Helpers\LogActivity`

## 4. Risiko & Peta Jalan

**Peluncuran Bertahap**:
- **MVP (Saat ini)**:
  - Frontend CMS lengkap: home, tentang, berita (daftar/detail), PSB (info/form/terima kasih), galeri; responsive mobile; Lighthouse >95; tema organik/alami dengan elemen Indonesia tradisional.
  - Panel Admin ERP dasar: manajemen santri (CRUD + foto), manajemen pengguna & peran, basic keuangan (input transaksi + lihat riwayat), basic inventaris (daftar barang).
  - Landing page statis yang ditampilkan sebagai halaman home CMS (bisa dirubah lewat setting).
- **v1.1**:
  - Tambah modul keuangan lengkap: kategori transaksi, saldo kas otomatis, laporan bulanan PDF/Excel.
  - Tambah modul inventaris lengkap: stok minimal, alert habis, peminjaman barang.
  - Sempurnakan sistem role & permission (gate policies).
  - Integrasi API v1 untuk ekspor data keuangan (JSON) untuk aplikasi seluler masa depan.
  - Penerapan caching query (tantangan): eager loading + cache hasil laporan.
- **v2.0**:
  - Dukungan multi-bahasa (ID/EN) untuk CMS dan admin (lang files).
  - Komentar pengguna pada berita (moderasi oleh admin).
  - Endpoint API v2 untuk aplikasi seluler (pendaftaran SSB, notifikasi push).
  - Tema gelap (dark mode) sebagai alternatif.
  - Pemindahan aset ke CDN (jika hosting mendukung) dan optimasi gambar otomatis.
  - Laporan dashboard grafik (Chart.js atau nilai Laravel bawaan) untuk keuangan dan inventaris.

**Risiko Teknis**:
1. **Keterbatasan Hosting Bersifat Anggaran**: Hosting bersama mungkin memiliki batas memori/waktu eksekusi PHP.
   - Mitigasi: Optimalisasi kueri (eager loading, select needed columns), caching view/query, minifikasi aset, gunakan queue untuk tugas berat (laporan PDF).
2. **Keterbatasan Stack Warisan**: Versi Laravel yang lebih lama mungkin kurang fitur baru.
   - Mitigasi: Manfaatkan fitur Laravel 10.x yang tersedia; implementasi tema dengan CSS vanilla; hindari paket yangbutuh versi tinggi.
3. **Lembaga Pengembang Tunggal**: Semua pekerjaan FE/BE dilakukan oleh satu orang.
   - Mitigasi: Prioritaskan fitur MVP; gunakan komponen Blade dan trait yang dapat dipakai ulang (mis. FormRequest base, tabel admin reusable).
4. **Fragmentasi Perangkat Seluler**: Rentang perangkat Android/iOS yang luas yang mengakses situs.
   - Mitigasi: Uji di BrowserStack/perangkat nyata; gunakan titik break responsif; deteksi fitur alih-alih pengindeteksian perambat; pastikan tema degradasi dengan sukses.
5. **Pemeliharaan Tema**: Memastikan konsistensi desain di seluruh pembaruan.
   - Mitigasi: Dokumentasikan variabel tema dan petunjuk penggunaan; buat Blade component untuk tombol/kartus; gunakan Laravel view komposer untuk variabel global.
6. **Kinerja Pemuatan Font**: Font kustom mungkin memengaruhi waktu muat awal.
   - Mitigasi: Gunakan font-display: swap; preload font kritis di `<head>`; subset font ke Latin-1 + karakter yang diperlukan; fallback ke font sistem.
7. **Keamanan Tambahan (role escalation)**:
   - Mitigasi: Gunakan Laravel Gates dan Policies secara konsisten; uji akses dengan Pest/PHPUnit; jangan bergantung hanya pada penalty di Blade.

## 5. Status Pengimplementasian

Berikut adalah checklist pencapaian tiap kriteria yang telah dikerjakan:

### 5.1 Kriteria Keberhasilan Umum & Frontend CMS
- [ ] Skor performa Lighthouse ≥95 untuk mobile dan desktop
- [ ] Waktu muat halaman <3 detik pada koneksi 3G yang disimulasikan
- [x] Pengalaman pengguna yang dioptimalkan untuk mobile dengan antarmuka yang ramah sentuh
- [x] Nol referensi rusak ke atribusi eksternal (Muhammad Iqbal/dibaliqaja diganti dengan branding CMS Pesantren)
- [x] Semua halaman CMS (home, tentang, berita, PSB, galeri) berfungsi penuh dan responsif
- [x] Warna primer: #0E9467 (biru tua - terinspirasi dari batik)
- [x] Warna sekunder: #8B4513 (terakota - tone bumi hangat)
- [x] Warna aksen: #D4AF37 (krim/emas - untuk highlight)
- [x] Tipografi: Kalam untuk header, Lora untuk teks utama
- [ ] Skor aksesibilitas Lighthouse minimal 90%
- [x] Penggunaan Heroicons konsisten di seluruh UI (frontend CMS dan panel admin)

### 5.2 Cerita Pengguna Wali Santri (Frontend PSB)
- [x] Formulir PSB dapat diakses dalam 2 ketukan dari halaman utama pada mobile
- [x] Kolom formulir dioptimalkan untuk input sentuh (area yang dapat disentuh minimal 48x48pt)
- [x] Validasi real-time dengan pesan kesalahan yang jelas
- [x] Halaman konfirmasi pengiriman dengan langkah selanjutnya
- [x] Formulir berfungsi pada perangkat Android berspesifikasi rendah (Android 8.0+)
- [x] Desain visual menggunakan tema organik/alami dengan palet warna batik yang diinspirasi (#0E9467, #8B4513, #D4AF37)
- [x] Header menggunakan font Kalam, teks utama menggunakan font Lora untuk penampilan tradisional namun mudah terbaca

### 5.3 Cerita Pengguna Anggota Publik (Berita & Galeri)
- [ ] Daftar berita dimuat dalam <2 detik pada koneksi 3G
- [ ] Gambar galeri dimuat dengan tulisan perlengkapan (lazy-load) dengan placeholder thumbnail
- [ ] Fungsi pencarian/filter mengembalikan hasil dalam 1 detik
- [x] Konten dapat dibaca tanpa perlu zoom (font dasar minimal 16px)
- [ ] Semua gambar memiliki teks alternatif yang sesuai untuk aksesibilitas
- [x] Desain mengadopsi tata letak asimetrik dengan spasi putih yang luas sesuai estetika organik/alami
- [ ] Pola geometris kustom yang diturunkan dari seni Islam digunakan sebagai tekstur latar belakang halus
- [ ] Batas dekoratif yang diinspirasi dari ukiran kayu tradisional digunakan pada kartu dan kontainer
- [x] Animasi hover halus dan mikro-interaksi memberikan umpan balik tanpa mengorbankan performa

### 5.4 Cerita Pengguna Admin Pesantren (Keuangan)
- [x] Semua konten dinamis diambil dari pengaturan/database CMS
- [x] Tidak ada tanggal, nama, atau informasi yang dihardcode di tampilan
- [ ] Tag meta SEO (OG/Twitter) diperbarui secara otomatis dengan konten
- [ ] Tahun hak cipta diperbarui secara otomatis
- [x] Branding konsisten di semua halaman (logo, warna, tipografi)
- [x] Variabel tema dipelihara dalam CSS untuk pembaruan mudah (--primary: #0E9467; --secondary: #8B4513; --accent: #D4AF37)
- [ ] Formulir transaksi keuangan mudah diakses dari dashboard
- [ ] Validasi jumlah harus numerik dan tidak boleh negatif untuk pemasukan (kecuali pengembalian)
- [ ] Riwayat transaksi dapat di_filter berdasarkan tanggal, jenis (masuk/keluar), dan kategori
- [ ] Export laporan ke PDF/Excel dengan satu klik
- [ ] Dashboard menunjukkan saldo kas terkini dan grafik tren 6 bulan terakhir
- [ ] Otorisasi: hanya pengguna dengan peran bendahara atau superadmin yang dapat mengakses modul keuangan

### 5.5 Cerita Pengguna Admin Akademik (Manajemen Santri)
- [x] Formulir santri mencakup: nama, tempat/tanggal lahir, jeniskelamin, alamat, no telepon, asal sekolah, nama ayah/ibu, pekerjaan orang tua, dll.
- [ ] Upload foto santri dengan validasi tipe file (jpg/png) dan ukuran maks 2MB
- [x] Data santri dapat di_cari berdasarkan nama, NISN, atau tahun masuk
- [ ] Riwayat kelas dan nilai dapat ditambahkan dan dilihat dalam satu tampilan
- [x] Otorisasi: hanya guru, kurasai, atau superadmin

### 5.6 Cerita Superadmin (Pengguna & Peran)
- [x] Manajemen pengguna: membuat, mengedit, menghapus akun; reset password
- [ ] Manajemen peran: memetakan izin (keuangan, akademik, inventaris) kepada peran
- [ ] Pengaturan sistem: mengubah nama pesantren, tahun berdiri, logo, kontak, dan preferensi notifikasi
- [x] Log aktivitas mencatat semua pengguna dan perubahan kritis
- [ ] Cadangan database dapat dijalankan manual atau terjadwal (hari Minggu jam 02:00)

### 5.7 Cerita Pengunjung Pertama (Landing Page / Home CMS)
- [x] Header dengan logo pesantren, nama, dan tagline (visi singkat)
- [x] Hero section dengan slideshow 3-5 gambar kegiatan terkait (hafalan, upacara, kelas)
- [x] Tombol CTA jelas: "Info PSB", "Lihat Galeri", "Hubungi Kami"
- [x] Seksi singkat tentang visi, misi, dan unggulan (prestasi akademik, kegiatan ekstrakurikuler)
- [x] Feed berita terbaru (3 item terakhir) dengan judul dan tanggal
- [x] Footer dengan alamat, nomor telepon, media sosial ikon, dan hak cipta
- [x] Semua elemen responsif dan memenuhi kriteria aksesibilitas minimum WCAG AA

**Keterangan**: Centang `[x]` menunjukkan fitur telah selesai dikerjakan, kosong `[ ]` menunjukkan masih dalam pengembangan atau belum dimulai.

Catatan: Beberapa item di atas sudah tercover oleh backend yang telah dibuat (mis. SantriController sudah lengkap). Silakan sesuaikan checklist dengan kemajuan nyata; Anda dapat menandakan `[x]` bila fitur tersebut sudah uji coba dan berjalan tanpa error.