<?php
session_start(); // Pastikan session sudah dimulai untuk memverifikasi login
require_once '../koneksi.php'; // Menghubungkan ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil ID pengguna dari session
$id = $_SESSION['id'];
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Validasi bahwa password baru tidak kosong dan cukup panjang
    if (strlen($new_password) < 8) {
        $error_message = "Password baru harus memiliki minimal 8 karakter.";
    } else {
        // Ambil password lama dari database untuk verifikasi
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if ($user && password_verify($current_password, $user['password'])) {
            // Jika password lama benar, hash password baru
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password di database
            $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            if ($update_stmt->execute([$hashed_new_password, $id])) {
                $success_message = "Password berhasil diperbarui.";
                $direct = "../login.php";
            } else {
                $error_message = "Terjadi kesalahan saat memperbarui password.";
            }
        } else {
            $error_message = "Password lama tidak benar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS untuk menyembunyikan halaman */
        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        /* style.css */

        /* Body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            background-color: #208780;
            color: #fff;
        }

        .sidebar .text-center h5 {
            color: #f8f9fa;
        }

        .sidebar .text-center small {
            color: #adb5bd;
        }

        .sidebar .nav-link {
            color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #196762;
            color: #fff;
        }

        /* Foto Profil */
        .sidebar img {
            border: 3px solid #adb5bd;
        }

        /* Main Content */
        main {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Section Headers */
        main h2 {
            color: #343a40;
            border-bottom: 2px solid #6c757d;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        /* Links */
        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar vh-100 d-flex flex-column align-items-center py-4">
                <div class="text-center mb-4">
                    <img src="uploads/<?php echo htmlspecialchars($user_photo); ?>" alt="Foto Profil" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
                    <h5 class="mb-0"><?php echo htmlspecialchars($username); ?></h5>
                    <small class="text-white">Jadwal Mengajar: Senin - Jumat, 08:00 - 14:00</small>
                </div>
                <ul class="nav flex-column w-100 px-3">
                    <li class="nav-item"><a class="nav-link active" href="#" data-page="dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-page="profile">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-page="class-management">Manajemen Kelas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-page="student-performance">Performa Siswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-page="assignments">Tugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-page="announcements">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-page="reports">Laporan</a></li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Halaman Dashboard -->
                <div class="page active" id="dashboard">
                    <h1 class="h2 mt-4">Dashboard Guru</h1>
                    <p>Selamat datang di dashboard guru.</p>

                    <div class="card mb-3">
                        <div class="card-header">Avatar</div>
                        <div class="card-body">
                            <img src="uploads/<?php echo htmlspecialchars($user_photo); ?>" alt="Avatar" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="mt-3">
                                <a href="#" class="btn btn-danger btn-sm">Hapus Foto</a>
                                <a href="#" class="btn btn-primary btn-sm">Ganti Foto</a>
                            </div>
                        </div>
                    </div>

                    <!-- Form Ubah Password -->
                    <div class="card mb-3">
                        <div class="card-header">Ubah Password</div>
                        <div class="card-body">
                            <?php if (isset($error_message)): ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($error_message); ?>
                                </div>
                            <?php elseif (isset($success_message)): ?>
                                <div class="alert alert-success">
                                    <?php echo htmlspecialchars($success_message); ?>
                                </div>
                            <?php endif; ?>

                            <form action="login.php" method="POST">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Lama</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Halaman Profil -->
                <div class="page" id="profile">
                    <h1 class="h2 mt-4">Profil</h1>
                    <p>Informasi dan pengaturan profil Anda.</p>
                </div>

                <!-- Halaman Manajemen Kelas -->
                <div class="page" id="class-management">
                    <h1 class="h2 mt-4">Manajemen Kelas</h1>
                    <p>Daftar kelas dan pengelolaan harian.</p>
                </div>

                <!-- Halaman Performa Siswa -->
                <div class="page" id="student-performance">
                    <h1 class="h2 mt-4">Performa Siswa</h1>
                    <p>Nilai dan catatan siswa.</p>
                </div>

                <!-- Halaman Tugas -->
                <div class="page" id="assignments">
                    <h1 class="h2 mt-4">Tugas</h1>
                    <p>Pengumpulan tugas dan penilaian.</p>
                </div>

                <!-- Halaman Pengumuman -->
                <div class="page" id="announcements">
                    <h1 class="h2 mt-4">Pengumuman</h1>
                    <p>Pembaruan untuk kelas atau siswa tertentu.</p>
                </div>

                <!-- Halaman Laporan -->
                <div class="page" id="reports">
                    <h1 class="h2 mt-4">Laporan</h1>
                    <p>Laporan performa siswa atau kelas.</p>
                </div>
            </main>
        </div>
    </div>

    <?php if (isset($direct)) : ?>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: 'success',
				title: '<?= $success_message ?>'
			})
		</script>
	<?php endif ?>

    <script>
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');

                document.querySelectorAll('.page').forEach(pageDiv => {
                    pageDiv.classList.remove('active');
                });

                document.getElementById(page).classList.add('active');

                document.querySelectorAll('.nav-link').forEach(nav => {
                    nav.classList.remove('active');
                });

                this.classList.add('active');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>