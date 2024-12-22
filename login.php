<?php
include "koneksi.php";
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $adminQuery = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $adminData = mysqli_fetch_assoc($adminQuery);

    if ($adminQuery->num_rows > 0) {
        // User login
        if ($adminData && $password == $adminData['password']) {
            $_SESSION['id'] = $adminData['id'];
            $_SESSION['username'] = $adminData['username'];
            $_SESSION['role'] = $adminData['role'];

            // Redirect based on role
            if ($adminData['role'] == 'admin') {
                $role_redirect = '/admin/index.php';
                $role_message = 'Redirecting to admin dashboard...';
            } elseif ($adminData['role'] == 'teacher') {
                $role_redirect = '/guru/index.php';
                $role_message = 'Redirecting to teacher pages...';
            } elseif ($adminData['role'] == 'student') {
                $role_redirect = '/siswa/index.php';
                $role_message = 'Redirecting to student pages...';
            }
            //  elseif ($adminData['role'] == 'Manajer') {
            //     $role_redirect = 'manajer/dashboard.php';
            //     $role_message = 'Redirecting to manajer dashboard...';
            // }
        } else {
            $error_message = 'Password salah! Coba lagi.';
        }
    } else {
        // Check in the pelanggan table
        $customerQuery = mysqli_query($conn, "SELECT * FROM pelanggan WHERE namaPelanggan = '$username'");
        $customerData = mysqli_fetch_assoc($customerQuery);

        if ($customerQuery->num_rows > 0) {
            // Customer login
            if ($customerData && $password == $customerData['password']) {
                $_SESSION['kodePelanggan'] = $customerData['kodePelanggan'];
                $_SESSION['namaPelanggan'] = $customerData['namaPelanggan'];
                $_SESSION['role'] = 'Pelanggan'; // Set a specific role for customers

                $role_redirect = 'pelanggan/liat_barang.php'; // Redirect to customer dashboard
                $role_message = 'Redirecting to your customer dashboard...';
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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/CSS/landing_page.css">
    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
                                <input type="checkbox" class="form-check-input" id="show-password"> <!-- checkbox liat password -->
                                <label class="form-check-label" for="show-password">
                                    Show Password
                                </label>
                            </div>
                            <div class="mt-2">
                                <a href="pelanggan/kelola_pelanggan.php" class="forget">Forgot Password</a>    `
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-utama mt-3" name="submit">Login</button>

                </form>
            </div>
            <div class="col-5 contact rounded-end d-flex flex-column align-items-center justify-content-center text-center"><!-- flex column is arranges the children (image and heading) in a vertical column -->
                <img src="assets/img/login.svg" alt="" class="w-100 px-5">
                <h5 class="mt-5 text-center">Login to get to our services</h5>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <?php if (isset($_GET['success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Berhasil membuat akun, sekarang tinggal login saja',
                confirmButtonText: 'Okeyyy'
            });
        <?php endif; ?>
    </script>
</body>

</html>