<?php
include "../koneksi.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    // echo json_encode(['success' => false, 'message' => 'User not logged in']);
    echo json_encode(['success' => false]);
    exit;
}

$user_id = $_SESSION['user_id'];
$response = ['success' => false];

// Handle file uploads
if (isset($_FILES['cover']) || isset($_FILES['icon'])) {
    $upload_dir = "uploads/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Save cover image
    if (isset($_FILES['cover'])) {
        $cover_name = time() . '_cover_' . basename($_FILES['cover']['name']);
        $cover_path = $upload_dir . $cover_name;

        if (move_uploaded_file($_FILES['cover']['tmp_name'], $cover_path)) {
            $cover_db_path = "uploads/" . $cover_name;
            mysqli_query($conn, "UPDATE dashboard SET cover_path = '$cover_db_path' WHERE user_id = '$user_id'");
            $response['cover_path'] = $cover_db_path;
        }
    }

    // Save icon image
    if (isset($_FILES['icon'])) {
        $icon_name = time() . '_icon_' . basename($_FILES['icon']['name']);
        $icon_path = $upload_dir . $icon_name;

        if (move_uploaded_file($_FILES['icon']['tmp_name'], $icon_path)) {
            $icon_db_path = "uploads/" . $icon_name;
            mysqli_query($conn, "UPDATE dashboard SET icon_path = '$icon_db_path' WHERE user_id = '$user_id'");
            $response['icon_path'] = $icon_db_path;
        }
    }

    $response['success'] = true;
}

// Handle title update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $result = mysqli_query($conn, "UPDATE dashboard SET title = '$title' WHERE user_id = '$user_id'");
    $response['success'] = $result ? true : false;
}

echo json_encode($response);


$default_cover = 'assets/default-cover.jpg';
$default_icon = 'assets/default-icon.png';

// Fetch dashboard data
$query = "SELECT title, cover_path, icon_path FROM dashboard WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$dashboard = mysqli_fetch_assoc($result);

$title = $dashboard['title'] ?? 'Student Planner';
$cover_path = $dashboard['cover_path'] ?? $default_cover;
$icon_path = $dashboard['icon_path'] ?? $default_icon;

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
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
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
        border-left: 4px solid #AB967D; /* Accent color for visual interest */
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
            color: #A1896E;
            /* Use your color palette for text */
            background-color: #E7E1DA;
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
            color: #fff;
            /* White text on hover */
            background-color: #A1896E;
            /* Darker background on hover */
            border-color: #A1896E;
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
                <div class="d-flex mt-2 mt-lg-0">
                    <button class="btn btn-outline-success me-2" type="button">Sign In</button>
                    <button class="btn btn-success" type="button">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>
    <div class="content" id="content">
        <!-- Cover Section -->
        <div class="cover-container" id="cover" style="background-image: url('<?php echo $cover_path; ?>');">
            <input type="file" id="cover-input" accept="image/*" onchange="updateCover()">
            <button class="change-cover-btn" onclick="document.getElementById('cover-input').click();">Change Cover</button>

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

        <a href="logout.php" class="btn-add-new">Logout</a>
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