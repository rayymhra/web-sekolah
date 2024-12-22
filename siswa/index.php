<?php
include "../koneksi.php";
session_start(); // Pastikan session dimulai

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit; // Berhenti agar tidak lanjutkan eksekusi halaman
}

$user_id = $_SESSION['id'];  // Menggunakan $_SESSION['id'] yang sudah didefinisikan pada login
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$photo = $_SESSION['photo'];
$response = ['success' => false];

// Menampilkan foto profil jika ada
if ($photo) {
    $icon_path = $photo; // Foto profil yang disimpan di folder uploads
} else {
    $icon_path = 'uploads/default-profile.png'; // Foto default jika tidak ada
}

// Relasi untuk mengambil foto profil dari tabel 'users'
$query = ("SELECT dashboard.title, dashboard.cover_path, dashboard.icon_path, users.photo FROM dashboard JOIN users ON dashboard.user_id = users.id WHERE dashboard.user_id = '$user_id'");
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(["success" => false, "message" => "Failed to fetch dashboard data: " . mysqli_error($conn)]);
    exit;
}

$dashboard = mysqli_fetch_assoc($result);

// Jika data dashboard tidak ditemukan, buatkan data default
if (!$dashboard) {
    // Membuat data dashboard baru jika tidak ada
    $default_cover = 'assets/default-cover.jpg';
    $default_icon = 'assets/default-icon.png';
    $default_title = 'Student Planner';

    // Insert data dashboard default
    $insert_query = "INSERT INTO dashboard (user_id, title, cover_path, icon_path) 
                     VALUES ('$user_id', '$default_title', '$default_cover', '$default_icon')";

    $insert_result = mysqli_query($conn, $insert_query);

    if (!$insert_result) {
        echo json_encode(["success" => false, "message" => "Failed to create default dashboard data"]);
        exit;
    }

    // Ambil data dashboard yang baru saja dimasukkan
    $dashboard = [
        'title' => $default_title,
        'cover_path' => $default_cover,
        'icon_path' => $default_icon
    ];
}

// Tentukan default value jika tidak ada dalam database
$title = $dashboard['title'] ?? 'Student Planner';
$cover_path = $dashboard['cover_path'] ?? 'assets/default-cover.jpg';
$icon_path = $dashboard['icon_path'] ?? 'assets/default-icon.png';

// Mengirimkan respon
$response['success'] = true;
$response['title'] = $title;
$response['cover_path'] = $cover_path;
$response['icon_path'] = $icon_path;

// echo json_encode($response);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa</title>
    <link rel="shortcut icon" href="../assets/img/bm3-header.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }


        .cover-container {
            position: relative;
            width: 100%;
            height: 200px;
            background: url('<?php echo $cover_path; ?>') center center/cover;
        }

        .cover-container input[type="file"] {
            display: none;
        }

        .change-cover-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 5px 10px;
            /* background: rgba(0, 0, 0, 0.5);  */
            /* color: #fff; */
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .icon-title-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
            margin-left: 10px;
        }

        .icon-title-container img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .editable-title {
            font-size: 1.5rem;
            font-weight: bold;
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
        }

        .dashboard-content {
            background-color: #f4f4f9;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .welcome-heading {
            font-size: 2rem;
            color: #2a2a2a;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .intro-text {
            font-size: 1.2rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .cta {
            background-color: #fff;
            padding: 1.2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #AB967D;
            /* Accent color for visual interest */
        }

        .cta p {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
        }

        .btn-add-new {
            display: inline-block;
            padding: 0.8rem 1.2rem;
            font-size: 1rem;
            font-weight: 500;
            /* color: #A1896E; */
            /* Use your color palette for text */
            /* background-color: #E7E1DA; */
            /* Subtle off-white background */
            border: 1px solid #D3C8BB;
            /* Light border */
            border-radius: 8px;
            /* Rounded corners */
            text-decoration: none;
            /* Remove underline */
            transition: all 0.3s ease;
            margin-bottom: 10px;
            margin-left: 30px;
        }

        .btn-add-new:hover {
            /* color: #fff; */
            /* White text on hover */
            /* background-color: #A1896E; */
            /* Darker background on hover */
            /* border-color: #A1896E; */
            /* Border color matches the background */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            /* Add subtle shadow */
        }

        .btn-add-new:active {
            transform: scale(0.98);
            /* Slightly shrink on click for effect */
        }

        .btn-add-new:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(161, 152, 110, 0.4);
            /* Focus outline with a soft glow */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm stikcy-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/bm3-logo.png" alt="Logo" height="30" class="logo d-inline-block align-text-top">
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
                        <a class="nav-link" href="../landing page/index.php#program">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
                <?php if (isset($_SESSION['id'])): ?>
                    <div class="d-flex ms-auto">
                        <!-- Display user profile photo and name -->
                        <div class="navbar-user">
                            <img src="<?php echo $icon_path; ?>" alt="Foto Profil" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                            <span class="ms-2"><?php echo htmlspecialchars($username); ?></span>
                        </div>
                        <a href="../logout.php" class="btn btn-warning ms-3">Logout</a>
                    </div>
                <?php else: ?>
                    <div class="d-flex mt-2 mt-lg-0">
                        <button class="btn btn-outline-success me-2" type="button">Sign In</button>
                        <button class="btn btn-success" type="button">Sign Up</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="content" id="content">
        <!-- Cover Section -->
        <div class="cover-container" id="cover" style="background-image: url('<?php echo $cover_path; ?>');">
            <input type="file" id="cover-input" accept="image/*" onchange="updateCover()">
            <button class="change-cover-btn btn btn-success" onclick="document.getElementById('cover-input').click();">Change Cover</button>

        </div>



        <!-- Icon and Title Section -->
        <div class="icon-title-container">
            <label for="icon-input">
                <img id="icon" src="<?php echo $icon_path; ?>" alt="Icon">
            </label>
            <input type="file" id="icon-input" accept="image/*" style="display:none" onchange="updateIcon()">

            <input type="text" id="title" class="editable-title" value="<?php echo htmlspecialchars($title); ?>" onblur="updateTitle()">
        </div>

        <div class="dashboard-content">
            <h3 class="welcome-heading">Welcome to Your Student Planner!</h3>
            <p class="intro-text">Organize, track, and personalize your academic life with ease. Whether it's assignments, exams, or daily tasks, you’re in control!</p>
            <div class="cta">
                <p>Get started by customizing your planner to fit your unique schedule and goals. Stay on top of your responsibilities with ease!</p>
            </div>
        </div>
    </div>

    <script>
        // Update cover image
        function updateCover() {
            const input = document.getElementById('cover-input');
            if (!input.files || input.files.length === 0) {
                alert("No file selected.");
                return;
            }

            const formData = new FormData();
            formData.append('cover', input.files[0]);

            fetch('update_dashboard.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        document.getElementById('cover').style.backgroundImage = `url(${data.cover_path})`;
                    } else {
                        alert('Failed to update cover image.');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the cover image.');
                });
        }


        // Update icon image
        function updateIcon() {
            const input = document.getElementById('icon-input');
            const formData = new FormData();
            formData.append('icon', input.files[0]);

            fetch('update_dashboard.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        document.getElementById('icon').src = data.icon_path;
                    } else {
                        alert('Failed to update icon image.');
                    }
                });
        }
    </script>
</body>

</html>