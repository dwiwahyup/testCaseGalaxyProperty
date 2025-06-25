# Salary Payment

Sistem ini dibangun dengan Laravel untuk mengelola proses pembayaran gaji karyawan di sebuah perusahaan dengan alur persetujuan multi-level. Sistem ini mencakup:
    - Manajemen pengguna dengan 3 peran berbeda
    - Proses pengajuan pembayaran gaji + bonus
    - Perhitungan otomatis PPH21 berdasarkan aturan pajak
    - Alur persetujuan oleh manajer
    - Pemrosesan pembayaran oleh divisi keuangan
    - Pelaporan untuk direktur
    - Sistem notifikasi real-time

## Spesifikasi Aplikasi

-   PHP 8.2
-   Laravel 11.31
-   MySQL Database

## Fitur Aplikasi

1. Manajemen Pengguna
    - Finance: Membuat pengajuan pembayaran gaji
    - Manager: Menyetujui/menolak pengajuan
    - Director: Melihat laporan pembayaran

2. Proses Pembayaran Gaji
    - Input gaji pokok dan bonus
    - Perhitungan otomatis PPH21:
        * ≤ 5 juta → 5%
        * 5-20 juta → 10%
        * 20 juta → 15%
    - Total gaji bersih otomatis terhitung

3. Alur Persetujuan
    - Finance mengajukan pembayaran (status: pending)
    - Manager menyetujui (approved) atau menolak (rejected)
    - Jika disetujui, finance memproses pembayaran (paid)
    - Director bisa melihat semua riwayat pembayaran

4. Sistem Notifikasi
    - Notifikasi real-time saat:
    - Pengajuan baru dibuat
    - Pengajuan disetujui/ditolak
    - Pembayaran selesai diproses

### Role Aplikasi

1. Finance
2. Manager
3. Director

#### Finance

-   Name        : Finance
-   Email       : finance@gmail.com
-   Password    : 1234

#### Manager

-   Name        : Manager
-   Email       : manager@gmail.com
-   Password    : 1234

#### Director

-   Name        : Director
-   Email       : director@gmail.com
-   Password    : 1234

Note: Semua akun passwordnya sama yaitu "1234"

## Cara Menggunakan

### 1. Finance

- Masuk ke aplikasi menggunakan akun finance
- Buat pengajuan pembayaran gaji pada menu payment dan membuka drop down (Salary Calculation) dengan mengisi form yang tersedia:
    * Pilih karyawan
    * Tambahkan bonus (jika ada)
    * Sistem akan otomatis menghitung PPH21 dan total gaji bersih
- Simpan pengajuan pembayaran
- Ajukan ke manager
- Jika sudah di approve manager bisa melakukan pembayaran dengan mengupload bukti transfer

### 2. Manager

- Login menggunakan akun Manager
- Akses halaman Payment Approval untuk melihat daftar pengajuan pembayaran gaji
- Review detail pengajuan yang berisi:
    * Informasi karyawan
    * Rincian gaji, bonus, dan pajak
    * Total yang akan dibayarkan
- Approve atau reject pengajuan dengan memberikan alasan jika ditolak

### 3. Director

- Login menggunakan akun Director
- Akses halaman Payment Report untuk melihat:
    * Ringkasan seluruh pembayaran gaji
    * Status pengajuan

## Instalasi

1. Clone repositori ini ke direktori lokal Anda.
2. Salin file `.env.example` menjadi `.env` dan atur konfigurasi database.
3. Jalankan perintah `composer install` untuk menginstal dependensi.
4. Jalankan perintah `php artisan key:generate` untuk menghasilkan kunci aplikasi.
5. Jalankan migrasi database dengan perintah `php artisan migrate`.
6. Jalankan perintah `php artisan db:seed` untuk memasukkan akun kedalam aplikasi.
7. Jalankan server dengan perintah `php artisan serve`.
