Berikut adalah README dalam bahasa Indonesia untuk proyek sistem manajemen toko buku internal yang Anda buat menggunakan PHP dan MySQL:

---

# Sistem Manajemen Toko Buku Internal

Ini adalah aplikasi web internal untuk mengelola inventaris toko buku, yang memungkinkan administrator untuk melihat, menambah, mengedit, dan menghapus data buku dan penerbit. Aplikasi ini juga memiliki bagian pengadaan untuk melacak buku yang perlu dipesan ulang.

## Fitur

Aplikasi web ini memiliki fitur utama sebagai berikut:

- **Beranda (Home)**: Menampilkan informasi umum tentang sistem.
- **Halaman Admin**: Untuk mengelola data toko buku, meliputi:
  - Menambah buku dan penerbit baru.
  - Mengedit atau menghapus data buku dan penerbit.
- **Halaman Pengadaan**: Menampilkan buku yang perlu dipesan ulang berdasarkan jumlah stok.
- **Database**: Menyimpan data buku dan penerbit dengan tabel relasional.

## Struktur Database

Sistem ini menggunakan dua tabel utama:

1. **Tabel Buku (buku)**
    - `id_buku`: ID Buku (Primary Key)
    - `kategori`: Kategori Buku
    - `nama_buku`: Judul Buku
    - `harga`: Harga Buku
    - `stok`: Jumlah Stok Buku
    - `id_penerbit`: ID Penerbit (Foreign Key yang terhubung ke tabel `penerbit`)

2. **Tabel Penerbit (penerbit)**
    - `id_penerbit`: ID Penerbit (Primary Key)
    - `nama`: Nama Penerbit
    - `alamat`: Alamat Penerbit
    - `kota`: Kota Penerbit
    - `telepon`: Nomor Telepon Penerbit

## Instalasi

### Prasyarat

- **XAMPP**: Pastikan XAMPP terinstal untuk menjalankan PHP dan MySQL.
- **Browser Web**: Chrome, Firefox, dll.

### Langkah-langkah Instalasi

1. **Kloning Repository**: Unduh atau kloning proyek ke komputer Anda.
    ```bash
    git clone <repository-url>
    ```

2. **Setup Database**:
    - Buka XAMPP dan jalankan **Apache** serta **MySQL**.
    - Buka **phpMyAdmin** dan buat database baru bernama `unibookstore`.
    - Import file `data.sql` (yang disertakan dalam repository ini) untuk membuat tabel dan mengisi data awal.

3. **Konfigurasi Koneksi Database**:
    - Buka file `db.php` dan sesuaikan kredensial database Anda.
    - Pastikan nama database sesuai dengan `unibookstore` (atau ubah sesuai kebutuhan).

4. **Jalankan Aplikasi**:
    - Tempatkan folder proyek di dalam direktori `htdocs` XAMPP.
    - Buka browser Anda dan akses `http://localhost/nama_folder_proyek_anda`.

## Struktur Proyek

- `index.php`: Beranda yang menampilkan semua buku dengan fitur pencarian.
- `admin.php`: Halaman admin untuk mengelola buku dan penerbit.
- `pengadaan.php`: Halaman pengadaan yang menampilkan buku dengan stok rendah.
- `db.php`: File koneksi database.
- `header.php` & `footer.php`: Header dan footer yang digunakan pada semua halaman.
- `css/`: Folder berisi file CSS untuk styling.

## Penggunaan

1. **Menambah Buku**: Gunakan halaman Admin untuk menambah buku baru dengan detail seperti ID, kategori, nama, harga, stok, dan penerbit.
2. **Mengelola Penerbit**: Tambah atau edit informasi penerbit seperti nama, alamat, kota, dan nomor telepon.
3. **Pengadaan**: Gunakan halaman pengadaan untuk melihat buku yang perlu dipesan ulang karena stok menipis.

## Peningkatan di Masa Depan

- Implementasi autentikasi pengguna untuk akses yang lebih aman.
- Penambahan paginasi untuk daftar buku.
- Peningkatan fungsionalitas pencarian.
- Menambahkan opsi ekspor CSV untuk laporan inventaris.

## Pemecahan Masalah

- **Masalah Koneksi Database**: Pastikan MySQL XAMPP berjalan dan kredensial di `db.php` sudah benar.
- **Tabel atau Data Tidak Ditemukan**: Pastikan `data.sql` sudah berhasil diimpor ke dalam database.

---
