<?php
session_start();
include "config/koneksi.php";

if(!isset($_SESSION['mahasiswa'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['mahasiswa'];

$user = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM mahasiswa
WHERE id_mahasiswa='$id'
"));

$total = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM antrian
WHERE id_mahasiswa='$id'
"));

$menunggu = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM antrian
WHERE id_mahasiswa='$id'
AND status='Menunggu'
"));

$selesai = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM antrian
WHERE id_mahasiswa='$id'
AND status='Selesai'
"));
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<?php include "includes/navbar.php"; ?>>

<div class="container mt-5">

<h2>

Selamat Datang,

<b><?= $user['nama']; ?></b>

</h2>

<p>

<?= $user['nim']; ?> |
<?= $user['prodi']; ?>

</p>

<div class="row mt-4">

<div class="col-md-4">

<div class="card shadow">

<div class="card-body text-center">

<i class="bi bi-ticket-perforated fs-1 text-primary"></i>

<h5 class="mt-3">

Total Antrian

</h5>

<h2><?= $total ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<div class="card-body text-center">

<i class="bi bi-clock-history fs-1 text-warning"></i>

<h5 class="mt-3">

Menunggu

</h5>

<h2><?= $menunggu ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<div class="card-body text-center">

<i class="bi bi-check-circle fs-1 text-success"></i>

<h5 class="mt-3">

Selesai

</h5>

<h2><?= $selesai ?></h2>

</div>

</div>

</div>

</div>

<div class="card mt-5 shadow">

<div class="card-header bg-primary text-white">

Menu Cepat

</div>

<div class="card-body">

<a href="ambil_antrian.php" class="btn btn-primary">

Ambil Antrian

</a>

<a href="riwayat.php" class="btn btn-success">

Riwayat

</a>

<a href="profil.php" class="btn btn-warning">

Profil

</a>

<a href="logout.php" class="btn btn-danger">

Logout

</a>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>