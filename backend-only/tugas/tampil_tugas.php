<?php
require '../koneksi.php';

// Proses hapus data jika ada permintaan DELETE
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query = "DELETE FROM assignments WHERE id = $delete_id";

    if ($conn->query($query) === TRUE) {
        echo "<p style='color: green;'>Tugas berhasil dihapus!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

// Query untuk mendapatkan semua tugas
$data = [];
$query = "SELECT * FROM assignments ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "<p>Tidak ada tugas tersedia.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
</head>
<body>
    <h1>Daftar Tugas</h1>
    <a href="input_tugas.php" style="text-decoration: none; background-color: blue; color: white; padding: 5px 10px;">Tambah Tugas</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tenggat Waktu</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Modul URL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $index => $row): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['teacher_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['class_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['drive_folder_id']); ?></td>
                        <td>
                            <a href="edit_tugas.php?id=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus tugas ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Tidak ada data tugas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
