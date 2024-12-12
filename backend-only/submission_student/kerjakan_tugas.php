<?php
require '../koneksi.php';

$assignment_id = $_GET['id'] ?? '';
$message = '';

// Validasi ID tugas
if (!$assignment_id) {
    header("Location: tampil_tugas_siswa.php");
    exit;
}

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'] ?? '';
    $drive_file_id = $_POST['drive_file_id'] ?? '';
    $submitted_at = date("Y-m-d H:i:s");

    if (empty($student_id) || empty($drive_file_id)) {
        $message = "Semua kolom harus diisi.";
    } else {
        // Query untuk menyimpan data
        $query = "INSERT INTO assignment_submissions (assignment_id, student_id, drive_file_id, submitted_at)
                  VALUES ('$assignment_id', '$student_id', '$drive_file_id', '$submitted_at')";

        if ($conn->query($query) === TRUE) {
            $message = "Tugas berhasil dikirim!";
        } else {
            $message = "Error: " . $query . "<br>" . $conn->error;
        }
    }
}

// Ambil data tugas untuk ditampilkan
$query = "SELECT * FROM assignments WHERE id = '$assignment_id'";
$result = $conn->query($query);
$tugas = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerjakan Tugas</title>
</head>
<body>
    <h1>Kerjakan Tugas</h1>

    <?php if (!empty($message)): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <h2><?php echo $tugas['title']; ?></h2>
    <p><?php echo $tugas['description']; ?></p>
    <p>Deadline: <?php echo $tugas['due_date']; ?></p>

    <form action="" method="POST">
        <label for="student_id">ID Siswa:</label>
        <input type="number" id="student_id" name="student_id" required>
        <br><br>

        <label for="drive_file_id">Link File Tugas:</label>
        <input type="text" id="drive_file_id" name="drive_file_id" required>
        <br><br>

        <button type="submit">Kirim Tugas</button>
    </form>
</body>
</html>
