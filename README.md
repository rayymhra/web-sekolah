# Dashboard Sekolah - Pendidikan

Dashboard Sekolah adalah sebuah platform yang berkomitmen untuk meningkatkan kualitas pendidikan melalui teknologi. Dengan berbagai fitur yang kami tawarkan, kami berharap dapat membantu sekolah dalam mengelola administrasi dan pembelajaran dengan lebih baik.

## Anggota Kolaborasi
- **Rayya Mahira:** [Fullstack Developer]
- **Muhammad Fauzan:** [Frontend Developer]
- **Joel Christo Kolibongso:** [Frontend Developer]
- **Naufal Ahmad Fadhil:** [Backend Developer]
- **Revantino Meysi:** [Frontend Developer]
- **Joshua Noel Siregar:** [Frontend Developer]
- **Ishaq Hafidz:** [Frontend Developer]
- **Samudra Cipta Bimantoro:** [Frontend Developer]

## Bahasa Pemrograman dan Framework
- **Bahasa Pemrograman:** PHP (PHP Native)
- **Database:** MySQL (utf8mb4_0900_ai_ci collation)
- **Frontend:** CSS, JavaScript
- **Tools Pendukung:**
  - XAMPP & Laragon untuk server lokal // pilih salah satu
  - phpMyAdmin untuk manajemen database
  - Git untuk version control

## Fitur Utama
1. Coming Soon

## Persiapan Lingkungan
Sebelum meng-clone dan menjalankan project ini, pastikan Anda memiliki:
1. **XAMPP atau Laragon:** Pastikan sudah terinstall dan menjalankan Apache serta MySQL.
2. **Git:** Untuk meng-clone repository.
3. **Browser:** Untuk mengakses website di localhost.

## Cara Clone dan Menjalankan Project
1. Clone repository ini menggunakan Git:
   ```bash
   git clone https://github.com/rayymhra/web-sekolah
   ```
2. Pindah ke direktori project:
   ```bash
   cd web-sekolah
   ```
3. Salin file project ke direktori `htdocs` di XAMPP atau `www` jika menggunakan Laragon
4. Buat database baru di phpMyAdmin dengan nama `sch_dashboardsekolah` dan import file database:
   - File SQL berada di folder `web-sekolah/sch_dashboardsekolah.sql`.
5. Konfigurasi file `koneksi.php` untuk koneksi database:
   ```php
   <?php
   $conn = mysqli_connect("localhost", "root", "your_password", "sch_dashboardsekolah");

   if($conn->connect_error){
      die("Tidak dapat terhubung:" . $conn->connect_error);
   }
   
   ?>
   ```
6. Jalankan XAMPP atau Laragon (Apache dan MySQL).
7. Akses website melalui browser:
   ```
   http://localhost/web-sekolah/
   ```

## Struktur Direktori
```
web-sekolah/
├── admin/                      # halaman admin
├── assets/                     # File CSS, JS, dan gambar
├── backend-only/               # file backend
├── bonus/                      # Secrets
├── guru/                       # Halaman guru
├── landing page/               # Halaman utama
├── siswa/                      # Halaman siswa
├── koneksi.php                 # Konfigurasi database
├── README.md                   # Dokumentasi project
└── sch_dashboardsekolah.sql    # Database website
```

## Lisensi
Project ini tidak ada license, karena hanya sebagai project kolaborasi saja

---

Untuk pertanyaan lebih lanjut atau diskusi, silakan hubungi [email@example.com].

## Desclaimer!
This project was made by class XI RPL 1 students.