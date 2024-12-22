<?php
include 'koneksi.php';

// Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $photo = $_FILES['photo'];

    // Validasi data
    if (empty($username) || empty($password) || empty($role) || empty($name) || empty($email)) {
        $error = "Semua kolom wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid.";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Upload file
        $photo_path = null;
        if ($photo['error'] === UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $photo_name = uniqid() . "_" . basename($photo['name']);
            $target_file = $target_dir . $photo_name;
            if (move_uploaded_file($photo['tmp_name'], $target_file)) {
                $photo_path = $target_file;
            } else {
                $error = "Gagal mengunggah foto.";
            }
        }

        if (empty($error)) {
            // Masukkan data ke database
            $stmt = $conn->prepare("INSERT INTO users (username, password, role, name, email, photo) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $hashed_password, $role, $name, $email, $photo_path);

            if ($stmt->execute()) {
                $success = "Pendaftaran berhasil.";
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .register-container {
            margin-top: 5%;
            background-color: #f8f9fa;
        }

        .register {
            padding: 3rem;
        }

        .register img {
            width: 150px;
        }

        .register .btn-utama {
            background-color: #208780;
            padding: 5px 15px;
            color: white;
            border: none;
            border-radius: 10px;
        }

        .register .btn-utama:hover {
            background-color: #196762;
        }

        .info {
            background-color: #208780;
            color: white;
            border-radius: 0 0.375rem 0.375rem 0;
        }
    </style>
</head>

<body>
    <div class="container shadow-lg rounded register-container">
        <div class="row">
            <!-- Form Section -->
            <div class="col-7 register">
                <img src="assets/img/bm3-logo.png" alt="" class="mb-3">
                <h4>Register Your Account</h4>
                <p>Create an account to access our services.</p>

                <form action="register.php" method="post" enctype="multipart/form-data">
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
                            <input type="password" class="form-control" name="password" required>
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="Admin">Admin</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" required>
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" required>
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" accept="image/*">
                    </div>
                    <button type="submit" class="btn-utama mt-3">Register</button>
                </form>
            </div>
            <!-- Info Section -->
            <div class="col-5 info rounded-end d-flex flex-column align-items-center justify-content-center text-center">
                <img src="assets/img/register.svg" alt="" class="w-75 px-5">
                <h5 class="mt-5">Join Our Platform</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>