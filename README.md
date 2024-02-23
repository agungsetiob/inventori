**Aplikasi Inventori Barang Sederhana**

Teknologi yang digunakan

 1. Laravel 10
 2. PHP 8.1
 3. PostgreSQL
 4. Tailwind CSS

Instalasi

1. Install package
```bash
composer install
```
2. Buat file .env dan konfigurasikan
```bash
cp .env.example .env
```
3. Generate application key
```bash
php artisan key:generate
```
4. Buat database di postgresql dan jalankan migration
```bash
php artisan migrate
```

Before run project
```bash
npm install
```
then 
```bash
npm run dev
```