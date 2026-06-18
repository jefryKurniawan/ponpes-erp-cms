# Pesantren CMS & ERP
> Platform terintegrasi untuk manajemen operasional Pesantren (ERP) dan publikasi (CMS). Dibangun dengan Laravel 10.

## Core Features

### CMS (Public)
- **Landing Page:** Profil, visi-misi, dan galeri kegiatan.
- **Penerimaan Santri Baru (PSB Online):** Portal pendaftaran mandiri.
- **Berita/Blog:** Manajemen pengumuman dan berita pesantren.

### ERP (Internal)
- **Akademik:** Manajemen kelas/asrama, penjadwalan, dan e-Rapor.
- **Keuangan:** Pembayaran SPP, biaya pendaftaran, dan Buku Kas Umum (Debit/Kredit).
- **Kesehatan (Poskestren):** Rekam medis dan stok apotek internal.
- **Kedisiplinan (E-Izin):** Sistem poin pelanggaran (Takzir) dan izin keluar digital.
- **SDM & Aset:** database staf, absensi, penggajian, dan inventaris.

### API
- **JWT Auth:** Endpoint siap digunakan untuk aplikasi mobile santri/orang tua.
- **Integrasi:** Siap diintegrasikan dengan WhatsApp Gateway untuk notifikasi tagihan.

## Tech Stack
- **Backend:** Laravel 10 (PHP 8.1+)
- **Database:** MySQL / MariaDB
- **Auth:** Session (Web) & JWT (API)
- **Reporting:** DomPDF untuk invoice dan laporan.

## Setup

1. **Clone & Install**
   ```bash
   git clone https://github.com/jefryKurniawan/ponpes-erp-cms.git
   cd ponpes-erp-cms
   composer install
   npm install && npm run dev
   ```

2. **Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan jwt:secret
   ```

3. **Database**
   Konfigurasi `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD), lalu:
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

4. **Run**
   ```bash
   php artisan serve
   ```

## Default Credentials
- **Admin:** `admin@ponpes.com` / `password`
- **Staff:** `pengurus@ponpes.com` / `password`
- **Student:** `santri@ponpes.com` / `password`

## Contributors
- **Jefry Kurniawan** - [jefryKurniawan](https://github.com/jefryKurniawan)
- **Muhammad Iqbal** - [dibaliqaja](https://github.com/dibaliqaja)

## License
MIT
