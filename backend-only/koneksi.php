<?php
$conn = mysqli_connect('localhost','root','','sch_dashboardsekolah');

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

?>