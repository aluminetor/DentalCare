# Installation from Scratch (Windows)

To run the project you need 4 tools: **PHP 8.3 or higher**, **MySQL**, **Composer**, and **Git**. Run all commands in **PowerShell**.

## 1. PHP + MySQL (WAMP)

Install **WAMP** (https://www.wampserver.com), which includes Apache, PHP, and MySQL (with phpMyAdmin). Start WAMP and wait until the tray icon turns **green**.

Ensure PHP 8.3+ is in your Windows `PATH` and verify with:

```powershell
php -v
```

Make sure these extensions are enabled in your CLI `php.ini`:

```ini
extension=pdo_mysql
extension=mbstring
extension=openssl
extension=fileinfo
extension=curl
```

## 2. Composer

Download and install **Composer-Setup.exe** from https://getcomposer.org/download/ and test with:

```powershell
composer -V
```

## 3. Clone and Set Up the Project

```powershell
git clone https://github.com/aluminetor/DentalCare.git
cd DentalCare
composer install
copy .env.example .env
php artisan key:generate
```

## 4. Create the Database

Open http://localhost/phpmyadmin (user `root`, empty password) → **New** → database name `dentalcare` → collation `utf8mb4_general_ci` → **Create**.

## 5. Run Migrations, Seeders, and Server

```powershell
php artisan migrate --seed
php artisan serve
```

Open http://localhost:8000.
