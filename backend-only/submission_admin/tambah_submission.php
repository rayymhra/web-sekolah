<?php
include '../koneksi.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assignment_id = $_POST['assignment_id'] ?? '';
    $student_id = $_POST['student_id'] ?? '';
    $file_url = $_POST['file_url'] ?? '';
    $submitted_at = date("Y-m-d H:i:s");

    if (empty($assignment_id) || empty($student_id) || empty($file_url)) {
        $message = "Semua kolom harus diisi.";
    } else {
        $query = "INSERT INTO assignment_submissions (assignment_id, student_id, file_url, submitted_at)
                  VALUES ('$assignment_id', '$student_id', '$file_url', '$submitted_at')";

        if ($conn->query($query) === TRUE) {
            header("Location: tampil_submission.php");
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
    <title>Tambah Submission</title>
</head>
<body>
    <h1>Tambah Submission</h1>

    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="assignment_id">ID Tugas:</label>
        <input type="number" id="assignment_id" name="assignment_id" required>
        <br><br>

        <label for="student_id">ID Siswa:</label>
        <input type="number" id="student_id" name="student_id" required>
        <br><br>

        <label for="file_url">File URL:</label>
        <input type="text" id="file_url" name="file_url" required>
        <br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
