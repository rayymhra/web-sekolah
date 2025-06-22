<?php
$conn = mysqli_connect('localhost','root','zanshere','sch_dashboardsekolah');

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

?>