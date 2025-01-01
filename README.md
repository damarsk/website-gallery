# Galeri Foto

Ini adalah proyek Laravel untuk mengelola galeri foto. Proyek ini memungkinkan pengguna untuk mengunggah, melihat, dan menghapus foto.

## Fitur

- Unggah foto
- Lihat daftar foto
- Hapus foto
- Autentikasi pengguna
- Panel Admin

## Instalasi

1. Clone repositori ini:
    ```bash
    git clone https://github.com/damarsk/website-gallery.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd website-gallery
    ```
3. Install dependensi menggunakan Composer:
    ```bash
    composer install
    ```
4. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:
    ```bash
    cp .env.example .env
    ```
5. Generate key aplikasi:
    ```bash
    php artisan key:generate
    ```
6. Migrasi database:
    ```bash
    php artisan migrate
    ```

## Penggunaan

1. Jalankan server pengembangan:
    ```bash
    php artisan serve
    ```
2. Akses aplikasi di browser:
    ```
    http://localhost:8000
    ```

## Kontribusi

Silakan buat pull request untuk kontribusi atau perbaikan bug.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
