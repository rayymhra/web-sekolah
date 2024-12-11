<?php
require '../koneksi.php';

// Proses data jika form disubmit
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $created_at = date("Y-m-d H:i:s");
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $teacher_id = $_POST['teacher_id'] ?? '';
    $class_id = $_POST['class_id'] ?? '';
    $drive_folder_id = $_POST['drive_folder_id']?? '';

    // Validasi sederhana
    if (empty($title) || empty($description) || empty($due_date) || empty($teacher_id)  || empty($class_id)  || empty($drive_folder_id)) {
        $message = "Semua kolom harus diisi.";
    } else {
        // Query untuk menyimpan data
        $query = "INSERT INTO assignments (title, description, due_date, teacher_id, class_id, created_at, drive_folder_id) 
                  VALUES ('$title', '$description', '$due_date', '$teacher_id', '$class_id', '$created_at', '$drive_folder_id')";

        // Eksekusi query
        if ($conn->query($query) === TRUE) {
            $message = "Tugas berhasil ditambahkan!";
        } else {
            $message = "Error: " . $query . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
</head>
<body>
    <h1>Tambah Tugas</h1>
    
    <!-- Tampilkan pesan jika ada -->
    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="title">title Tugas:</label>
        <input type="text" id="title" name="title" required>
        <br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        <br><br>

        <label for="due_date">Tenggat Waktu:</label>
        <input type="datetime-local" id="due_date" name="due_date" required>
        <br><br>

        <label for="teacher_id">ID Guru:</label>
        <input type="number" id="teacher_id" name="teacher_id" required>
        <br><br>

        <label for="teacher_id">ID Kelas:</label>
        <input type="number" id="class_id" name="class_id" required>
        <br><br>

        <label for="drive_folder_id">Modul url:</label>
        <textarea id="drive_folder_id" name="drive_folder_id" rows="4" required></textarea>
        <br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
