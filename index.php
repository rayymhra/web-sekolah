<?php 
include_once __DIR__ . '/config/baseURL.php';

// Header
include __DIR__ . '/includes/header.php';

?>

    <!-- Header -->
    <header class="text-white text-center">
        <img src="<?= base_url('assets/img/bm3-header.png') ?>" alt="Header Image"><br>
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
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center h-100 feature-card">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/paper.png') ?>" alt="Manajemen Data Siswa" class="feature-icon mb-3">
                            <h5 class="card-title text-dark">Manajemen Data Siswa</h5>
                            <p class="card-text text-dark">Mempermudah pengelolaan data siswa secara efisien dan terorganisir.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100 feature-card">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/paper.png') ?>" alt="Pengajaran Interaktif" class="feature-icon mb-3">
                            <h5 class="card-title text-dark">Pengajaran Interaktif</h5>
                            <p class="card-text text-dark">Mendukung metode pengajaran yang lebih interaktif dan menarik bagi siswa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100 feature-card">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/report.png') ?>" alt="Laporan dan Analisis" class="feature-icon mb-3">
                            <h5 class="card-title text-dark">Laporan dan Analisis</h5>
                            <p class="card-text text-dark">Memberikan laporan dan analisis yang mendalam untuk pengambilan keputusan yang lebih baik.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Section Program -->
    <section id="program" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 text-light">Program Keahlian</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center h-100 feature-card">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/RPL.png') ?>" alt="Rekayasa Perangkat Lunak" class="feature-icon mb-3">
                            <h5 class="card-title text-dark">Rekayasa Perangkat Lunak (RPL)</h5>
                            <p class="card-text text-dark">Berfokus pada pengembangan perangkat lunak, mencakup penguasaan pemrograman, desain sistem, dan aplikasi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100 feature-card">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/TKJ.png') ?>" alt="Teknik Komputer dan Jaringan" class="feature-icon mb-3">
                            <h5 class="card-title text-dark">Teknik Komputer dan Jaringan (TKJ)</h5>
                            <p class="card-text text-dark">Mengajarkan instalasi jaringan, perawatan perangkat keras, dan konfigurasi perangkat jaringan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100 feature-card">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/DKV.png') ?>" alt="Desain Komunikasi Visual" class="feature-icon mb-3">
                            <h5 class="card-title text-dark">Desain Komunikasi Visual (DKV)</h5>
                            <p class="card-text text-dark">Menekankan pada kreativitas desain grafis, branding, dan multimedia interaktif.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-5 pt-5" style="background-color: #f9f9f9 ;">
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
 <?php include __DIR__ . '/includes/footer.php'; ?>