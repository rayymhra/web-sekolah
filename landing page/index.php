<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="shortcut icon" href="../assets/img/bm3-header.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #f8f9fa;
        }

        .navbar-brand img {
            height: 30px;
        }

        header {
            background-color: #208780;
            padding: 60px 0;
            text-align: center;
        }

        header img {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            height: auto;
        }

        header h1 {
            font-weight: bold;
            font-size: 2.5rem;
        }

        header p {
            font-size: 1.2rem;
        }

        .feature-icon {
            height: 60px;
        }

        .feature-card {
            transition: transform 0.3s;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
        }

        .feature-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #133e59;
        }

        footer p {
            margin: 0;
        }

        .bg-light {
            background-color: #f0f0f0 !important;
        }

        .text-dark {
            color: #333 !important;
        }

        .text-white {
            color: #ffffff !important;
        }

        .text-primary {
            color: #007bff !important;
        }

        /* New styles for spacing */
        section {
            padding: 60px 0;
            /* Add padding to each section */
        }

        h2 {
            margin-bottom: 40px;
            /* Add margin to headings */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/bm3-logo.png" alt="Logo" class="logo d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#program">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Kontak</a>
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
    <header class="text-white text-center">
        <img src="../assets/img/bm3-header.png" alt="Header Image"><br>
        <div class="container">
            <h1 class="display-5">Selamat Datang di Dashboard Sekolah</h1>
            <p class="lead mt-3">Platform digital untuk mendukung pembelajaran dan administrasi sekolah</p>
            <a href="#fitur" class="btn btn-light mt-4">Jelajahi Fitur</a>
        </div>
    </header>

    <!-- Bagian Fitur -->
    <section id="fitur" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #133e59;">Fitur Unggulan</h2>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 text-center feature-card">
                    <img src="../assets/img/paper.png" alt="Manajemen Data Siswa" class="feature-icon mb-3">
                    <h5 class="text-dark">Manajemen Data Siswa</h5>
                    <p class="text-dark">Mempermudah pengelolaan data siswa secara efisien dan terorganisir.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center feature-card">
                    <img src="../assets/img/teacher.png" alt="Pengajaran Interaktif" class="feature-icon mb-3">
                    <h5 class="text-dark">Pengajaran Interaktif</h5>
                    <p class="text-dark">Mendukung metode pengajaran yang lebih interaktif dan menarik bagi siswa.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center feature-card">
                    <img src="../assets/img/report.png" alt="Laporan dan Analisis" class="feature-icon mb-3">
                    <h5 class="text-dark">Laporan dan Analisis</h5>
                    <p class="text-dark">Memberikan laporan dan analisis yang mendalam untuk pengambilan keputusan yang lebih baik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Program -->
    <section id="program" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 text-light">Program Keahlian</h2>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 text-center feature-card">
                    <img src="../assets/img/RPL.png" alt="Rekayasa Perangkat Lunak" class="feature-icon mb-3">
                    <h5 class="text-dark">Rekayasa Perangkat Lunak (RPL)</h5>
                    <p class="text-dark">Berfokus pada pengembangan perangkat lunak, mencakup penguasaan pemrograman, desain sistem, dan aplikasi.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center feature-card">
                    <img src="../assets/img/TKJ.png" alt="Teknik Komputer dan Jaringan" class="feature-icon mb-3">
                    <h5 class="text-dark">Teknik Komputer dan Jaringan (TKJ)</h5>
                    <p class="text-dark">Mengajarkan instalasi jaringan, perawatan perangkat keras, dan konfigurasi perangkat jaringan.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center feature-card">
                    <img src="../assets/img/DKV.png" alt="Desain Komunikasi Visual" class="feature-icon mb-3">
                    <h5 class="text-dark">Desain Komunikasi Visual (DKV)</h5>
                    <p class="text-dark">Menekankan pada kreativitas desain grafis, branding, dan multimedia interaktif.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-5" style="background-color: #f9f9f9 ;">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #133e59;">Tentang Kami</h2>
            <p class="text-center text-dark">
                Kami adalah platform yang berkomitmen untuk meningkatkan kualitas pendidikan melalui teknologi.
                Dengan berbagai fitur yang kami tawarkan, kami berharap dapat membantu sekolah dalam
                mengelola administrasi dan pembelajaran dengan lebih baik.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white text-center py-4">
        <div class="container">
            <p>&copy; 2023 Dashboard Sekolah. All rights reserved.</p>
            <p><a href="#" class="text-white">Kebijakan Privasi</a> | <a href="#" class="text-white">Syarat dan Ketentuan</a></p>
        </div>
    </footer>
</body>

</html>