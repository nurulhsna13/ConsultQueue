<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_GET['hapus'])){

    $id=$_GET['hapus'];

    mysqli_query($conn,"
    DELETE FROM mahasiswa
    WHERE id_mahasiswa='$id'
    ");

    header("Location:mahasiswa.php");
    exit;
}

$data=mysqli_query($conn,"
SELECT * FROM mahasiswa
ORDER BY id_mahasiswa DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Mahasiswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="bg-light">

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<h2>Data Mahasiswa</h2>

<a href="dashboard.php" class="btn btn-secondary">

Kembali

</a>

</div>

<div class="card shadow">

<div class="card-header bg-primary text-white">

Daftar Mahasiswa

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th width="60">No</th>

<th>NIM</th>

<th>Nama</th>

<th>Program Studi</th>

<th>Email</th>

<th width="120">Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no=1;

while($m=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $m['nim']; ?></td>

<td><?= $m['nama']; ?></td>

<td><?= $m['prodi']; ?></td>

<td><?= $m['email']; ?></td>

<td>

<a
href="?hapus=<?= $m['id_mahasiswa'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

<?php if(mysqli_num_rows($data)==0){ ?>

<tr>

<td colspan="6" class="text-center">

Belum ada data mahasiswa.

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>