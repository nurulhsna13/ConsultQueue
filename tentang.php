<?php
session_start();

if(!isset($_SESSION['mahasiswa'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tentang | ConsultQueue</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include "navbar.php"; ?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3 class="mb-0">

<i class="bi bi-info-circle"></i>

Tentang Aplikasi

</h3>

</div>

<div class="card-body">

<h4>ConsultQueue</h4>

<p>

ConsultQueue merupakan aplikasi berbasis web yang dibuat untuk membantu proses antrian konsultasi dosen secara online.

</p>

<p>

Mahasiswa tidak perlu lagi datang lebih awal hanya untuk mengambil nomor antrian. Semua proses dilakukan melalui website sehingga lebih cepat, tertib, dan mudah dipantau.

</p>

<hr>

<h5>Fitur Aplikasi</h5>

<ul>

<li>Registrasi Mahasiswa</li>

<li>Login Mahasiswa dan Admin</li>

<li>Melihat Jadwal Konsultasi</li>

<li>Mengambil Nomor Antrian</li>

<li>Melihat Riwayat Konsultasi</li>

<li>Kelola Dosen</li>

<li>Kelola Jadwal</li>

<li>Kelola Mahasiswa</li>

<li>Kelola Antrian</li>

<li>Cetak Laporan</li>

</ul>

<hr>

<h5>Teknologi</h5>

<table class="table table-bordered">

<tr>

<th width="200">

Bahasa Pemrograman

</th>

<td>

PHP Native

</td>

</tr>

<tr>

<th>

Database

</th>

<td>

MySQL

</td>

</tr>

<tr>

<th>

Framework CSS

</th>

<td>

Bootstrap 5

</td>

</tr>

<tr>

<th>

Web Server

</th>

<td>

Apache (XAMPP)

</td>

</tr>

</table>

<a href="dashboard.php" class="btn btn-primary">

Kembali

</a>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>