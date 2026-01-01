# Sistem Inventaris Sekolah

Aplikasi manajemen inventaris sekolah sederhana built with Laravel.

## Prasyarat
Sebelum menginstal, pastikan teman-teman sudah menginstal:
* PHP (minimal 8.1)
* Composer
* Node.js & NPM
* Server Database (MySQL/MariaDB) - direkomendasikan menggunakan Laragon atau XAMPP.

## Langkah-langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di komputer lokal:

### 1. Clone Repositori
Buka terminal/command prompt, lalu jalankan:
```bash
git clone https://github.com/Yohansepti/inventaris-sekolah.git
cd inventaris-sekolah
```

### 2. Instal Dependency PHP
Jalankan perintah berikut untuk menginstal vendor folder:
```bash
composer install
```

### 3. Instal Dependency Frontend
Jalankan perintah berikut untuk menginstal node_modules:
```bash
npm install
```

### 4. Setup File Environment
Copy file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
*Catatan: Jika di Windows manual, cukup copy-paste file `.env.example` dan ubah namanya menjadi `.env`.*

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Konfigurasi Database
1. Buka file `.env` yang baru dibuat.
2. Cari bagian database dan sesuaikan dengan database lokal kamu:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventaris_sekolah
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Buat database baru di phpMyAdmin/HeidiSQL dengan nama `inventaris_sekolah`.

### 7. Jalankan Migrasi dan Seeder
Untuk membuat tabel dan mengisi data awal (user admin, dll):
```bash
php artisan migrate --seed
```

### 8. Jalankan Aplikasi
Jalankan server lokal:
```bash
php artisan serve
```
Aplikasi bisa diakses di: `http://127.0.0.1:8000`

### 9. Jalankan Vite (Untuk Aset CSS/JS)
Buka terminal baru di folder yang sama:
```bash
npm run dev
```

---

## Akun Login Default
(Silakan cek `DatabaseSeeder.php` atau `UserSeeder.php` untuk melihat email & password default).

## Penulis
* **Yohan Septi** - [Yohansepti](https://github.com/Yohansepti)
