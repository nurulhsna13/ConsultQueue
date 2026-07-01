<?php
session_start();
include "config/koneksi.php";

if(!isset($_SESSION['mahasiswa'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['mahasiswa'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM mahasiswa
WHERE id_mahasiswa='$id'
"));

if(isset($_POST['simpan'])){

    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $prodi = mysqli_real_escape_string($conn,$_POST['prodi']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);

    mysqli_query($conn,"
    UPDATE mahasiswa SET
    nama='$nama',
    prodi='$prodi',
    email='$email'
    WHERE id_mahasiswa='$id'
    ");

    echo "<script>
    alert('Profil berhasil diperbarui');
    window.location='profil.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Profil Mahasiswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include "includes/navbar.php"; ?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning text-dark">

<h4>Profil Mahasiswa</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>NIM</label>

<input
type="text"
class="form-control"
value="<?= $data['nim']; ?>"
readonly>

</div>

<div class="mb-3">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $data['nama']; ?>"
required>

</div>

<div class="mb-3">

<label>Program Studi</label>

<input
type="text"
name="prodi"
class="form-control"
value="<?= $data['prodi']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= $data['email']; ?>"
required>

</div>

<button
type="submit"
name="simpan"
class="btn btn-primary">

Simpan Perubahan

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>