<?php
session_start();
require __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../config/baseURL.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek di tabel pengguna (users) untuk admin, guru, atau siswa
    $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if ($userQuery) {
        $userData = mysqli_fetch_assoc($userQuery);

        if ($userQuery->num_rows > 0) {
            // Jika ada pengguna dengan username yang ditemukan
            if (password_verify($password, $userData['password'])) { // Verifikasi password menggunakan password_verify
                $_SESSION['id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['role'] = $userData['role']; // Menyimpan role pengguna
                $_SESSION['photo'] = $userData['photo'];  // Menyimpan path foto profil

                // Redirect berdasarkan role
                if ($userData['role'] == 'admin') {
                    $role_redirect = base_url('admin/index.php'); // Halaman admin
                    $role_message = 'Hi ' . $_SESSION['username'] . ', Redirecting to admin dashboard...';
                } elseif ($userData['role'] == 'teacher') {
                    $role_redirect = base_url('pages/guru/index.php'); // Halaman guru
                    $role_message = 'Hi ' . $_SESSION['username'] . ', Redirecting to guru dashboard...';
                } elseif ($userData['role'] == 'student') {
                    $role_redirect = base_url('pages/siswa/index.php'); // Halaman siswa
                    $role_message = 'Hi ' . $_SESSION['username'] . ', Redirecting to siswa dashboard...';
                } else {
                    $error_message = 'Role tidak dikenali!';
                }
            } else {
                $error_message = 'Password salah! Coba lagi.';
            }
        } else {
            $error_message = 'Akun tidak terdaftar! Pastikan username yang anda tulis benar.';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/bm3-header.png') ?>" type="image/x-icon">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container shadow-lg rounded login-container">
        <div class="row">
            <div class="col-7 login">
                <img src="assets/img/bm3-logo.png" alt="" class="mb-3">
                <h4>Log in to your Account</h4>
                <p>Let's explore our school dashboard</p>

                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" required>
                            <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        </div>
                        <div class="password-footer d-flex justify-content-between">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="show-password">
                                <label class="form-check-label" for="show-password">Show Password</label>
                            </div>
                            <div class="mt-2">
                                <a href="forgot_password.php" class="forget">Forgot Password</a>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-utama mt-3" name="submit">Login</button>

                </form>
            </div>
            <div class="col-5 contact rounded-end d-flex flex-column align-items-center justify-content-center text-center">
                <img src="<?= base_url('assets/img/login.svg') ?>" alt="" class="w-100 px-5">
                <h5 class="mt-5 text-center">Login to get to our services</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
        </div>
    </div>

    <?php if (isset($role_redirect)) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: '<?php echo $role_message; ?>',
                confirmButtonColor: '#208780'
            }).then(function() {
                window.location.href = '<?php echo $role_redirect; ?>'; //redirect sesuai role
            });
        </script>
    <?php elseif (isset($error_message)) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo $error_message; ?>',
                confirmButtonColor: '#208780'
            });
        </script>
    <?php endif; ?>

    <script>
        // Show and hide password
        const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('show-password');

        showPasswordCheckbox.addEventListener('change', function() {
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>
</html>