<?php
include 'koneksi.php';

$id = $_GET['id'] ?? '';
if (!$id) {
    header("Location: tampil_submission.php");
    exit;
}

$message = '';
$query = "SELECT * FROM assignment_submissions WHERE id = '$id'";
$result = $conn->query($query);
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assignment_id = $_POST['assignment_id'] ?? '';
    $student_id = $_POST['student_id'] ?? '';
    $file_url = $_POST['file_url'] ?? '';

    if (empty($assignment_id) || empty($student_id) || empty($file_url)) {
        $message = "Semua kolom harus diisi.";
    } else {
        $query = "UPDATE assignment_submissions SET 
                  assignment_id = '$assignment_id', 
                  student_id = '$student_id', 
                  file_url = '$file_url'
                  WHERE id = '$id'";

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
    <title>Edit Submission</title>
</head>
<body>
    <h1>Edit Submission</h1>

    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="assignment_id">ID Tugas:</label>
        <input type="number" id="assignment_id" name="assignment_id" value="<?php echo $data['assignment_id']; ?>" required>
        <br><br>

        <label for="student_id">ID Siswa:</label>
        <input type="number" id="student_id" name="student_id" value="<?php echo $data['student_id']; ?>" required>
        <br><br>

        <label for="file_url">File URL:</label>
        <input type="text" id="file_url" name="file_url" value="<?php echo $data['file_url']; ?>" required>
        <br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
