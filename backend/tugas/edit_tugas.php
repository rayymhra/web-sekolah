<?php
require '../koneksi.php';

// Cek apakah parameter id tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tugas tidak ditemukan.");
}

$id = intval($_GET['id']);
$message = '';

// Ambil data tugas berdasarkan ID
$query = "SELECT * FROM assignments WHERE id = $id";
$result = $conn->query($query);

if ($result->num_rows === 0) {
    die("Tugas tidak ditemukan.");
}

$assignment = $result->fetch_assoc();

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $teacher_id = $_POST['teacher_id'] ?? '';
    $class_id = $_POST['class_id'] ?? '';
    $drive_folder_id = $_POST['drive_folder_id'] ?? '';

    // Validasi sederhana
    if (empty($title) || empty($description) || empty($due_date) || empty($teacher_id) || empty($class_id)) {
        $message = "Semua kolom harus diisi.";
    } else {
        // Query untuk update data tugas
        $query = "UPDATE assignments SET 
                    title = '$title', 
                    description = '$description', 
                    due_date = '$due_date', 
                    teacher_id = '$teacher_id', 
                    class_id = '$class_id',
                    drive_folder_id = '$drive_folder_id'
                  WHERE id = $id";

        // Eksekusi query
        if ($conn->query($query) === TRUE) {
            $message = "Tugas berhasil diperbarui!";
            header("Location: tampil_tugas.php"); // Redirect setelah sukses
            exit;
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
    <title>Edit Tugas</title>
</head>
<body>
    <h1>Edit Tugas</h1>

    <!-- Tampilkan pesan jika ada -->
    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="title">Judul Tugas:</label>
        <input type="text" id="title" name="title" value="<?php echo $assignment['title']; ?>" required>
        <br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" rows="4" required><?php echo $assignment['description']; ?></textarea>
        <br><br>

        <label for="due_date">Tenggat Waktu:</label>
        <input type="datetime-local" id="due_date" name="due_date" value="<?php echo date('Y-m-d\TH:i', strtotime($assignment['due_date'])); ?>" required>
        <br><br>

        <label for="teacher_id">ID Guru:</label>
        <input type="number" id="teacher_id" name="teacher_id" value="<?php echo $assignment['teacher_id']; ?>" required>
        <br><br>

        <label for="class_id">ID Kelas:</label>
        <input type="number" id="class_id" name="class_id" value="<?php echo $assignment['class_id']; ?>" required>
        <br><br>

        <label for="drive_folder_id">Modul URL:</label>
        <textarea id="drive_folder_id" name="drive_folder_id" rows="4" required><?php echo $assignment['drive_folder_id']; ?></textarea>
        <br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="tampil_tugas.php">Kembali ke Daftar Tugas</a>
</body>
</html>
