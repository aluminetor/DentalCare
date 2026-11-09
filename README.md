# DentalCare – Dental Clinic Management System

Web application for managing **patients and appointments** at a dental clinic, featuring dynamic users, roles, and permissions.
Group project for the PHP course (Laravel + MySQL + Bootstrap).

> Design documents are located in [`docs/`](docs): the **permission matrix** (`.xlsx`, containing database schema and business rules) and the **ERD diagram** (`.drawio`, opens at https://app.diagrams.net).

## Stack

Laravel 13 · PHP 8.3 or higher · MySQL · Blade · Bootstrap template (Medicio) · Local jQuery and SweetAlert2 (`public/libs`).

## First-Time Installation

You need PHP 8.3+, Composer, MySQL, and Git. Complete step-by-step guide for Windows: [`docs/INSTALACION.md`](docs/INSTALACION.md).

With everything installed, open PowerShell inside the project folder:

```powershell
composer install
copy .env.example .env
php artisan key:generate
# create an empty database named "dentalcare" in MySQL (phpMyAdmin or console)
php artisan migrate --seed
php artisan serve
```

Open http://localhost:8000 and navigate to **Patients** in the menu.

`php artisan migrate --seed` creates all tables and loads: 3 roles, 17 permissions, 3 sample users, and 3 sample patients. Test credentials (password `password`):

| Role | Email |
| --- | --- |
| Administrator | admin@dentalcare.test |
| Receptionist | reception@dentalcare.test |
| Dentist | dentist@dentalcare.test |

To reset the database from scratch: `php artisan migrate:fresh --seed`.

## Module Status

| Module | Status | Owner |
| --- | --- | --- |
| Patients | ✅ Full CRUD (reference module) | — |
| Appointments | ✅ Full CRUD | |
| Users | ✅ Full CRUD with permissions | |
| Roles and permissions | 🟡 View templates ready | |
| Login / logout / role-based permissions | ✅ Ready (`permission:` middleware) | |

## Project Organization

| Component | Location |
| --- | --- |
| Routes (one file per module) | `routes/web/<module>.php` (included in `routes/web.php`) |
| Controllers | `app/Http/Controllers/<Module>Controller.php` |
| Models | `app/Models` |
| Migrations and seed data | `database/migrations`, `database/seeders/DatabaseSeeder.php` |
| Views | `resources/views/<module>/{index,create,edit}.blade.php` |
| Layout (menu, scripts, alerts) | `resources/views/layouts` |

Naming conventions: all tables, columns, models, controllers, routes, views, and error/validation messages are written in English following standard Laravel conventions (`patients`, `appointments`, `users`, `roles`, `permissions`, `permission_role`).
