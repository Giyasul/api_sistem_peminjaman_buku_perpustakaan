# 📚 API Sistem Peminjaman Buku Perpustakaan

> RESTful API untuk pengelolaan sistem perpustakaan digital mencakup manajemen buku, kategori, anggota, dan transaksi peminjaman buku.

---

## 📖 Deskripsi Singkat

**API Sistem Peminjaman Buku Perpustakaan** adalah layanan Web Service berbasis RESTful API yang dibangun menggunakan **Laravel** dan **JWT Authentication**. Sistem ini dirancang untuk memudahkan pengelolaan data perpustakaan secara digital dan terintegrasi.

Fitur utama yang tersedia:
- 🔐 Autentikasi pengguna menggunakan JWT (register, login, logout)
- 📚 Manajemen data buku dan kategori buku
- 👥 Manajemen data anggota perpustakaan
- 📋 Transaksi peminjaman dan pengembalian buku (dengan pengecekan stok otomatis)
- 📝 Log aktivitas otomatis setiap request tercatat ke database

---

## ⚙️ Cara Menjalankan Sistem

### Persyaratan
- PHP >= 8.2
- Composer
- MySQL
- Laravel Herd / XAMPP / Laragon

### Langkah-langkah

**1. Clone repositori**
```bash
git clone https://github.com/username/api_sistem_peminjaman_buku_perpustakaan.git
cd api_sistem_peminjaman_buku_perpustakaan
```

**2. Install dependency**
```bash
composer install
```

**3. Salin file konfigurasi**
```bash
cp .env.example .env
```

**4. Generate application key**
```bash
php artisan key:generate
```

**5. Konfigurasi file `.env`**

Buka file `.env` dan sesuaikan bagian berikut:
```env
APP_NAME=LibraryAPI
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_peminjaman_buku_perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

**6. Generate JWT Secret**
```bash
php artisan jwt:secret
```

**7. Jalankan migrasi dan seeder**
```bash
php artisan migrate --seed
```

**8. Jalankan server**
```bash
php artisan serve
```

API dapat diakses di: `http://localhost:8000/api`

---

## 👤 Informasi Akun Uji Coba

Setelah menjalankan seeder, akun berikut sudah tersedia dan siap digunakan:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@library.com | password123 |
| Petugas | petugas1@library.com | password123 |

> **Cara login:** Kirim request `POST /api/login` dengan email dan password di atas, lalu gunakan token yang didapat sebagai `Bearer Token` di header Authorization untuk mengakses endpoint lainnya.

---

## 📡 Daftar Endpoint

### 🔐 Auth
| Method | Endpoint | Keterangan |
|--------|----------|------------|
| POST | /api/register | Registrasi user baru |
| POST | /api/login | Login dan dapatkan token JWT |
| POST | /api/logout | Logout dan invalidasi token |
| GET | /api/me | Ambil data user yang sedang login |

### 👤 Users
| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/user | Daftar semua user |
| GET | /api/user/{id} | Detail user |
| PUT | /api/user/{id} | Update data user |
| DELETE | /api/user/{id} | Hapus user |

### 📂 Categories
| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/categories | Daftar semua kategori |
| POST | /api/categories | Tambah kategori baru |
| GET | /api/categories/{id} | Detail kategori |
| PUT | /api/categories/{id} | Update kategori |
| DELETE | /api/categories/{id} | Hapus kategori |
| GET | /api/categories/{id}/books | Daftar buku berdasarkan kategori |

### 📚 Books
| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/books | Daftar semua buku |
| POST | /api/books | Tambah buku baru |
| GET | /api/books/{id} | Detail buku |
| PUT | /api/books/{id} | Update data buku |
| DELETE | /api/books/{id} | Hapus buku |
| GET | /api/books/dipinjam | Daftar buku yang sedang dipinjam |

### 👥 Members
| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/member | Daftar semua anggota |
| POST | /api/member | Tambah anggota baru |
| GET | /api/member/{id} | Detail anggota |
| PUT | /api/member/{id} | Update data anggota |
| DELETE | /api/member/{id} | Hapus anggota |
| GET | /api/members/{id}/pinjaman | Riwayat pinjaman per anggota |

### 📋 Pinjaman
| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/loan | Daftar semua pinjaman |
| POST | /api/loan | Buat transaksi pinjaman baru |
| GET | /api/loan/{id} | Detail pinjaman |
| PUT | /api/loan/{id} | Update status pinjaman / kembalikan buku |
| DELETE | /api/loan/{id} | Hapus data pinjaman |
| GET | /api/pinjaman/aktif | Daftar pinjaman yang belum dikembalikan |
| GET | /api/pinjaman/overdue | Daftar pinjaman yang melewati batas waktu |

### 📊 Dashboard & Log
| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/dashboard | Statistik keseluruhan sistem |
| GET | /api/log | Riwayat log aktivitas sistem |

---

## 📄 Dokumentasi API

Dokumentasi lengkap endpoint tersedia secara online melalui tautan berikut:

🔗 **[Lihat Dokumentasi API](https://documenter.getpostman.com/view/43068266/2sBXwqrAPD)**

Dokumentasi mencakup detail endpoint, method, parameter, contoh request, dan contoh response untuk seluruh fitur sistem.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| Laravel 13 | Framework PHP untuk membangun RESTful API |
| MySQL | Database untuk menyimpan data sistem |
| JWT Auth | Autentikasi berbasis JSON Web Token (tymon/jwt-auth) |
| Postman | Tools untuk testing dan dokumentasi API |
| GitHub | Version control dan pengumpulan proyek |

---

## 👨‍💻 Tim Pengembang

| Nama | NIM | Tugas |
|------|-----|-------|
| Giyasul Firdaus Fasni | 2301040037 | Arsitektur sistem, endpoint Auth, Books, Categories, JWT middleware |
| Haidir Ali | 2301040011 | Endpoint Members, Loans |
| Tio Alvandi Ahmad Prasetya | 2301040026 | Endpoint Kategori Buku, Buku |

---

*Proyek UAS Mata Kuliah Pemrograman Web Service — Genap 2025/2026 | Universitas Bumigora*
