# Comprehensive Project Guide: Pesantren CMS & ERP (Integrated Platform)

## 1. Project Vision & Context
**Pesantren CMS & ERP** adalah platform terintegrasi yang dirancang untuk mengelola seluruh ekosistem Pondok Pesantren secara profesional dan scalable. 

Berbeda dengan versi dasar, proyek ini dikembangkan untuk menjadi solusi **All-in-One**:
- **CMS (Content Management System):** Untuk mengelola kehadiran publik pesantren (Landing page, pengumuman, blog berita).
- **ERP (Enterprise Resource Planning):** Untuk mengelola operasional internal (Akademik, Keuangan, SDM, Inventaris, dan Aset).

Tujuan utama adalah menciptakan sistem yang modular, aman, dan siap untuk skala besar (Multi-tenant/Multi-cabang).

---

## 2. Scalable Architecture & Tech Stack

### Backend Core (High Performance)
- **Framework:** Laravel 10.x (PHP 8.1+)
- **Pattern:** Modular Monolith / Repository Pattern (untuk skalabilitas logika bisnis).
- **Multi-Tenancy Ready:** Struktur database dirancang agar mendukung pemisahan data antar cabang pesantren (di masa depan).
- **Security:** JWT untuk Mobile API, Sanctum/Session untuk Web, Role-Based Access Control (RBAC) yang lebih dinamis.

### Frontend & UI/UX
- **Admin Panel:** Bootstrap/Tailwind dengan komponen modular.
- **CMS Front-end:** Template Blade yang SEO Friendly untuk profil pesantren.
- **Mobile Integration:** API v1 (JWT) untuk aplikasi santri dan wali santri.

---

## 3. Expanded Module & Feature Map (ERP Side)

### A. Core Modules (Current)
1.  **Student Management (Santri):** Biodata lengkap, berkas digital, dan riwayat kesehatan.
2.  **Financial (Keuangan):** 
    - Manajemen SPP & Pendaftaran.
    - Buku Kas Umum (Debit/Kredit).
    - Cetak PDF Invoice & Laporan Keuangan.

### B. ERP Expansion Modules (Scalability Focus)
1.  **Academic & Curriculum:**
    - Manajemen Kelas & Asrama.
    - Penjadwalan Mata Pelajaran & Kitab.
    - Sistem E-Rapor & Evaluasi Santri.
2.  **Human Resources (SDM/Pegawai):**
    - Data Ustadz/Ustadzah & Staf.
    - Absensi Pegawai (Geofencing/QR).
    - Manajemen Gaji (Payroll) sederhana.
3.  **Inventory & Asset:**
    - Manajemen stok koperasi/kantin.
    - Inventaris aset gedung dan fasilitas pondok.
4.  **Communication Hub:**
    - Notifikasi WhatsApp Gateway (Integration).
    - Portal Berita & Pengumuman internal.

### C. Advanced ERP Modules (Niche & Specialized)
1.  **Health & Medical (Poskestren):**
    - Rekam medis santri & riwayat penyakit.
    - Inventaris obat-obatan (Apotek internal).
    - Log kunjungan klinik pesantren.
2.  **Counseling & Discipline (BK/Kesiswaan):**
    - Sistem poin pelanggaran & prestasi (Takzir & Reward).
    - Log konseling santri.
    - Manajemen perizinan keluar-masuk pondok (E-Izin).
3.  **Laundry Management:**
    - Antrean laundry santri per asrama.
    - Status pengerjaan & pengambilan.
4.  **Library (Maktabah):**
    - Katalog kitab & buku umum.
    - Sistem peminjaman & denda otomatis.
5.  **Alumni & Career Portal:**
    - Database alumni & networking.
    - Tracer study (melacak sebaran alumni).
6.  **Donation & Waqf Management:**
    - Manajemen donatur eksternal.
    - Pelaporan penggunaan dana wakaf & hibah.

---

## 4. CMS Features (Public Facing)
- **Landing Page Builder:** Pengaturan profil pondok, visi-misi, dan galeri.
- **Admission System (PSB Online):** Formulir pendaftaran mandiri untuk calon santri.
- **Blog/News:** Publikasi kegiatan dan prestasi pesantren.

---

## 5. Database Schema Strategy

### Key Entities
- **`users`**: RBAC System (`admin`, `pengurus`, `ustadz`, `bendahara`).
- **`santris`**: Master data dengan relasi ke `kelas` dan `asrama`.
- **`transactions`**: Unified transaction table untuk semua jenis arus kas (SPP, Kantin, Donasi).
- **`settings`**: Konfigurasi CMS (Logo, Nama Pondok, Kontak).
- **`posts` / `pages`**: Data konten untuk sisi CMS.

---

## 6. API Documentation Strategy (v1)

### Prefix: `/api/v1/`
- **Auth:** Login multi-user (Santri/Wali).
- **Academic:** Jadwal & Nilai.
- **Finance:** Histori bayar & Tagihan aktif.
- **CMS Data:** Fetch berita/pengumuman terbaru untuk aplikasi mobile.

---

## 7. Development Guidelines & Scaling
- **Modularity:** Pisahkan logika bisnis dari Controller ke Service/Repository Layer.
- **Migration Policy:** Gunakan migrasi yang bersih dengan foreign key dan indexing yang tepat untuk performa query data besar.
- **Validation:** Strict validation menggunakan Request Classes.
- **API First:** Bangun fitur baru dengan mindset API-ready agar mudah diintegrasikan ke platform lain.

---

## 8. Strategic Roadmap
- **Phase 1:** Refactoring codebase fork lama ke struktur yang lebih modular.
- **Phase 2:** Implementasi Modul Akademik & Penjadwalan.
- **Phase 3:** Integrasi Payment Gateway (VA & E-wallet).
- **Phase 4:** WhatsApp Automation untuk tagihan & pengumuman.
- **Phase 5:** Dashboard Analytic untuk pimpinan pesantren (Decision Support System).
