# DepEd Division Office — Appointment Booking System

A Laravel-based appointment booking and queue management system for the DepEd Division Office. Visitors book appointments at the kiosk or mobile view; office staff validate bookings; and administration staff issue and print Certificates of Appearance (COA).

## Features

- **Public kiosk / mobile booking** — Walk-in clients select an office, service, and time slot
- **Office booking management** — Office staff validate, hide, or manage incoming bookings
- **Certificate of Appearance (COA)** — Issued after a booking is validated and the client completes a survey; printable with or without e-signature
- **Role-based access** — `admin`, `administration`, `validator`, `employee` roles via Spatie Permission
- **Admin panel** — Manage users, roles, permissions, offices, services, and app settings
- **Survey system** — Post-visit satisfaction survey linked to each booking

## Roles

| Role | Access |
|---|---|
| `admin` | Full system access, admin dashboard |
| `administration` | View and print Certificates of Appearance; redirected to COA dashboard on login |
| `validator` | Validate bookings for their assigned office |
| `employee` | Basic authenticated access |

## Requirements

- PHP 8.2+
- MySQL 8+
- Node.js 18+
- Composer

## Installation

```bash
# 1. Clone the repository
git clone <repo-url>
cd booking

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies and build assets
npm install
npm run build

# 4. Publish vendor assets (AdminLTE, DataTables, etc.)
php artisan vendor:publish --all

# 5. Configure environment
cp .env.example .env
php artisan key:generate

# Edit .env with your database credentials, then:

# 6. Run migrations and seed
php artisan migrate
php artisan db:seed

# 7. Create storage symlink
php artisan storage:link
```

## Default Seeded Accounts

All accounts use the password **`password`**.

| Email | Role | Notes |
|---|---|---|
| `admin@book.app` | `admin` | Full system access |
| `useradmin@book.app` | `administration` | COA view & print |
| `adminoffice@book.app` | `administration` | COA view & print |
| `sds@book.app` | `validator` | SDS Office |
| `cid@book.app` | `validator` | CID |
| `sgod@book.app` | `validator` | SGOD |
| `admindiv@book.app` | `validator` | Administrative Division |
| `hrmd@book.app` | `validator` | HRMD |
| `budget@book.app` | `validator` | Budget and Finance |
| `records@book.app` | `validator` | Records Section |
| `ict@book.app` | `validator` | ICT Unit |
| `legal@book.app` | `validator` | Legal Unit |
| `planning@book.app` | `validator` | Planning and Research |

## Tech Stack

- **Framework:** Laravel 12
- **UI:** AdminLTE 3 + Tailwind CSS
- **Auth:** Laravel Breeze
- **Roles/Permissions:** Spatie Laravel Permission
- **Tables:** Yajra DataTables
- **QR codes:** SimpleSoftwareIO QrCode
