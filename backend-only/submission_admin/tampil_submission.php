<?php
include '../koneksi.php';

// Query data submissions
$query = "SELECT * FROM assignment_submissions";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Terkumpul</title>
</head>
<body>
    <h1>Daftar Tugas Terkumpul</h1>

    <a href="tambah_submission.php">Tambah Submission</a><br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Tugas</th>
                <th>ID Siswa</th>
                <th>File URL</th>
                <th>Tanggal Pengumpulan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['assignment_id']; ?></td>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo $row['file_url']; ?></td>
                    <td><?php echo $row['submitted_at']; ?></td>
                    <td>
                        <a href="edit_submission.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                        <a href="hapus_submission.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
