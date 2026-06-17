# Pesantren CMS & ERP

Integrated platform for managing Pesantren operations (ERP) and public presence (CMS). Built with Laravel 10.

## Core Features

### CMS (Public)
- **Landing Page:** Profile, vision-mission, and activity gallery.
- **Online Admission (PSB):** Student self-registration portal.
- **News/Blog:** News and announcement management.

### ERP (Internal)
- **Academic:** Class/Dormitory management, scheduling, and digital report cards (e-Rapor).
- **Finance:** SPP (Monthly fees) tracking, registration fees, and General Cash Book (Debit/Credit).
- **Health (Poskestren):** Medical records and internal pharmacy stock.
- **Discipline (E-Izin):** Point-based violation system (Takzir) and digital exit permits.
- **HR & Assets:** Staff database, attendance, payroll, and inventory tracking.

### API
- **JWT Auth:** Mobile-ready endpoints for students and parents.
- **Integration:** WhatsApp Gateway ready for billing notifications.

## Tech Stack
- **Backend:** Laravel 10 (PHP 8.1+)
- **Database:** MySQL / MariaDB
- **Auth:** Session (Web) & JWT (API)
- **Reporting:** DomPDF for invoice/report generation

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
   Configure `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD), then:
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

## Documentation
Technical details and roadmap are available in [docs/prd.md](docs/prd.md).

## License
MIT
