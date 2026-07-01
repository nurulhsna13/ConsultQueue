<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_POST['tambah'])){

    $nidn=mysqli_real_escape_string($conn,$_POST['nidn']);
    $nama=mysqli_real_escape_string($conn,$_POST['nama_dosen']);
    $prodi=mysqli_real_escape_string($conn,$_POST['prodi']);

    mysqli_query($conn,"INSERT INTO dosen(nidn,nama_dosen,prodi)
    VALUES('$nidn','$nama','$prodi')");

    header("Location:dosen.php");
}

if(isset($_POST['edit'])){

    $id=$_POST['id_dosen'];
    $nidn=mysqli_real_escape_string($conn,$_POST['nidn']);
    $nama=mysqli_real_escape_string($conn,$_POST['nama_dosen']);
    $prodi=mysqli_real_escape_string($conn,$_POST['prodi']);

    mysqli_query($conn,"
    UPDATE dosen SET
    nidn='$nidn',
    nama_dosen='$nama',
    prodi='$prodi'
    WHERE id_dosen='$id'
    ");

    header("Location:dosen.php");
}

if(isset($_GET['hapus'])){

    mysqli_query($conn,"
    DELETE FROM dosen
    WHERE id_dosen='".$_GET['hapus']."'
    ");

    header("Location:dosen.php");
}

$data=mysqli_query($conn,"
SELECT * FROM dosen
ORDER BY id_dosen DESC
");
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Data Dosen</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<h2>Data Dosen</h2>

<a href="dashboard.php" class="btn btn-secondary">

Kembali

</a>

</div>

<div class="card shadow">

<div class="card-header bg-primary text-white">

Tambah Dosen

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-3">

<input
type="text"
name="nidn"
class="form-control"
placeholder="NIDN"
required>

</div>

<div class="col-md-3">

<input
type="text"
name="nama_dosen"
class="form-control"
placeholder="Nama Dosen"
required>

</div>

<div class="col-md-3">

<input
type="text"
name="prodi"
class="form-control"
placeholder="Program Studi"
required>

</div>

<div class="col-md-3">

<button
name="tambah"
class="btn btn-primary w-100">

Tambah

</button>

</div>

</div>

</form>

</div>

</div>

<br>

<div class="card shadow">

<div class="card-header bg-success text-white">

Daftar Dosen

</div>

<div class="card-body">

<table class="table table-bordered">

<tr class="table-primary">

<th>No</th>

<th>NIDN</th>

<th>Nama</th>

<th>Prodi</th>

<th>Aksi</th>

</tr>

<?php
$no=1;

while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nidn'] ?></td>

<td><?= $d['nama_dosen'] ?></td>

<td><?= $d['prodi'] ?></td>

<td>

<button
class="btn btn-warning btn-sm"
data-bs-toggle="modal"
data-bs-target="#edit<?= $d['id_dosen']; ?>">

Edit

</button>

<a
href="?hapus=<?= $d['id_dosen']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

</tr>

<div class="modal fade" id="edit<?= $d['id_dosen']; ?>">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST">

<div class="modal-header">

<h5>Edit Dosen</h5>

</div>

<div class="modal-body">

<input
type="hidden"
name="id_dosen"
value="<?= $d['id_dosen']; ?>">

<input
type="text"
name="nidn"
class="form-control mb-2"
value="<?= $d['nidn']; ?>">

<input
type="text"
name="nama_dosen"
class="form-control mb-2"
value="<?= $d['nama_dosen']; ?>">

<input
type="text"
name="prodi"
class="form-control"
value="<?= $d['prodi']; ?>">

</div>

<div class="modal-footer">

<button
name="edit"
class="btn btn-primary">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

<?php } ?>

</table>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>