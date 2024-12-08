<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/CSS/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/bm3.png" alt="Logo" height="30" class="logo d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex mt-2 mt-lg-0">
                    <button class="btn btn-outline-primary me-2" type="button">Sign In</button>
                    <button class="btn btn-primary" type="button">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class=" text-white text-center py-5" style="background-color: #208780;">
        <div class="container">
            <h1 class="display-5" style="font-weight: bold;">Selamat Datang di Dashboard Sekolah</h1>
            <p class="lead mt-3">Platform digital untuk mendukung pembelajaran dan administrasi sekolah</p>
            <a href="#fitur" class="btn btn-light mt-4">Jelajahi Fitur</a>
        </div>
    </header>

    <!-- Bagian Fitur -->
    <section id="fitur" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #133e59;">Fitur Unggulan</h2>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 text-center">
                    <img src="../assets/img/paper.png" alt="Manajemen Data Siswa" class="mb-3" height="50">
                    <h5>Manajemen Data Siswa</h5>
                    <p>Mempermudah pengelolaan data siswa dengan cepat dan aman.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <img src="../assets/img/globe.png" alt="E-Learning" class="mb-3" height="50">
                    <h5>E-Learning</h5>
                    <p>Platform pembelajaran online dengan fitur lengkap.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <img src="../assets/img/report.png" alt="Laporan Akademik" class="mb-3" height="50">
                    <h5>Laporan Akademik</h5>
                    <p>Penyusunan laporan hasil belajar siswa yang terintegrasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Tentang Kami -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #133e59;">Tentang Kami</h2>
            <p class="text-center">Dashboard Sekolah adalah solusi digital untuk mempermudah pengelolaan administrasi sekolah, mendukung proses belajar-mengajar, dan meningkatkan komunikasi antara guru, siswa, dan orang tua.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class=" text-white text-center py-4">
        <div class="container" style="display: block;">
            <p class="mb-0">&copy; 2024 Dashboard Sekolah. Dikembangkan oleh Tim IT</p>
        </div>
    </footer>

    <!-- JavaScript -->
     <script src="../assets/JS/main.js"></script>
</body>

</html>