<?php
include "../koneksi.php";
$successMessage = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    if (mysqli_query($conn, "INSERT INTO admin(username, password, level) VALUES ('$username', '$password', '$level')")) {
        $successMessage = "User created successfully!";
        header("Location: kelola_user.php?success=1"); //redirect to prevent form resubmission, then sweetalert
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// ngambil data users
$users = mysqli_query($conn, "SELECT * FROM admin");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/style.css">
    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- DataTables CSS for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
</head>

<body>
<nav class="navbar">
    <div class="container my-2">
      <h4 class="my-auto text-white">Kasir Meli</h4>
      <div class="btn-group ms-auto">
        <!-- <a href="notif.php" class="btn btn-danger border-0">
          Notifications <span class="badge bg-danger"><?= $unreadCount ?></span>
        </a> -->
        <div class="btn-group ms-auto">
          <a href="dashboard.php" class="btn btn-danger border-0">Admin</a>
          <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split border-0" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="visually-hidden"></span>
          </button>
          <ul class="dropdown-menu border-0">
            <!-- <li><a class="dropdown-item" href="kelola_barang.php">Kelola Barang</a></li> -->
            <li><a class="dropdown-item" href="../kelola_pemasok.php">Kelola Pemasok</a></li>
            <!-- <li><a class="dropdown-item" href="pemasok/kelola_barang.php">Kelola Barang</a></li> -->
            <li><a class="dropdown-item" href="kelola_user.php">Kelola User</a></li>
            <li><a class="dropdown-item" href="../pelanggan/kelola_pelanggan.php">Kelola Pelanggan</a></li>
            <li><a class="dropdown-item" href="../liat_barang.php">Liat Barang</a></li>
            <li><a class="dropdown-item" href="../lihat_po.php">Permintaan PO</a></li>

            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="../../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

    <div class="container">
        <div class="img-register mb-4">
            <img src="../img/logo text.png" alt="">
        </div>
        <h4>Kelola Akun</h4>
        <p>Lorem ipsum dolor sit amet.</p>

        <div class="register">
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="username">
                        <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    </div>
                    <div class="password-footer">
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="show-password">
                            <label class="form-check-label" for="show-password">
                                Show Password
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select class="form-select" aria-label="Default select example" name="level">
                        <option selected disabled>Select Level</option>
                        <option value="Admin">Admin</option>
                        <option value="Pemasok">Pemasok</option>
                        <option value="Manajer">Manajer</option>
                    </select>
                </div>


                <button type="submit" name="submit" class="btn btn-danger mt-3 mb-5">Add User</button>

            </form>


        </div>

        <table id="userTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($users) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($users)) {
                        echo "<tr>
                                <td>" . $i++ . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['password'] . "</td>
                                <td>" . $row['level'] . "</td>
                                <td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-danger mb-1'>Edit</a>
                            <button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                </td>
                            </tr>";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
    </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables JS for Bootstrap 5 -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>


    <script>
        // Initialize DataTables with Bootstrap 5 styling
        $(document).ready(function() {
            $('#userTable').DataTable({
                "pagingType": "simple_numbers", // Use simple pagination
                "lengthMenu": [5, 10, 25, 50], // Options for showing records
                "pageLength": 5, // Default number of records shown
            });
        });

        // Show SweetAlert after redirecting
        <?php if (isset($_GET['success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'User created successfully!',
                confirmButtonText: 'Okeyyy'
            });
        <?php endif; ?>
    </script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "delete.php?id=" + id; // Redirect to delete.php
                }
            })
        }

        // Show SweetAlert on successful delete
        <?php if (isset($_GET['delete']) && $_GET['delete'] == 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'User has been deleted successfully.'
            });
        <?php endif; ?>
    </script>

</body>

</html>