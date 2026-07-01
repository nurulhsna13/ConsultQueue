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

<title>Kontak | ConsultQueue</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include "navbar.php"; ?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>

<i class="bi bi-envelope-fill"></i>

Kontak Admin

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<h5>Informasi</h5>

<table class="table table-bordered">

<tr>

<th width="180">

Email

</th>

<td>

admin@consultqueue.com

</td>

</tr>

<tr>

<th>

Telepon

</th>

<td>

0812-3456-7890

</td>

</tr>

<tr>

<th>

Jam Pelayanan

</th>

<td>

Senin - Jumat

08.00 - 16.00 WIB

</td>

</tr>

<tr>

<th>

Alamat

</th>

<td>

Universitas Islam Riau

</td>

</tr>

</table>

</div>

<div class="col-md-6">

<h5>Kirim Pesan</h5>

<form>

<div class="mb-3">

<label>Nama</label>

<input
type="text"
class="form-control"
placeholder="Masukkan nama">

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
class="form-control"
placeholder="Masukkan email">

</div>

<div class="mb-3">

<label>Pesan</label>

<textarea
class="form-control"
rows="5"
placeholder="Masukkan pesan"></textarea>

</div>

<button
type="button"
class="btn btn-success"
onclick="kirimPesan()">

Kirim Pesan

</button>

</form>

</div>

</div>

<div class="mt-4">

<a href="dashboard.php" class="btn btn-secondary">

Kembali ke Dashboard

</a>

</div>

</div>

</div>

</div>

<script src="assets/js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>