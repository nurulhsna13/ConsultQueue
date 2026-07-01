<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

// ======================
// UPDATE STATUS
// ======================

if(isset($_GET['aksi']) && isset($_GET['id'])){

    $id = (int)$_GET['id'];
    $aksi = $_GET['aksi'];

    if($aksi=="panggil"){

        mysqli_query($conn,"
        UPDATE antrian
        SET status='Dipanggil'
        WHERE id_antrian='$id'
        ");

    }

    if($aksi=="selesai"){

        mysqli_query($conn,"
        UPDATE antrian
        SET status='Selesai'
        WHERE id_antrian='$id'
        ");

    }

    header("Location: antrian.php");
    exit;
}

// ======================
// HAPUS
// ======================

if(isset($_GET['hapus'])){

    $id=(int)$_GET['hapus'];

    mysqli_query($conn,"
    DELETE FROM antrian
    WHERE id_antrian='$id'
    ");

    header("Location: antrian.php");
    exit;

}

// ======================
// DATA ANTRIAN
// ======================

$data=mysqli_query($conn,"

SELECT

antrian.*,

mahasiswa.nim,
mahasiswa.nama,

dosen.nama_dosen,

jadwal.hari,
jadwal.jam_mulai,
jadwal.jam_selesai

FROM antrian

INNER JOIN mahasiswa
ON mahasiswa.id_mahasiswa=antrian.id_mahasiswa

INNER JOIN jadwal
ON jadwal.id_jadwal=antrian.id_jadwal

INNER JOIN dosen
ON dosen.id_dosen=jadwal.id_dosen

ORDER BY
antrian.tanggal DESC,
antrian.nomor_antrian ASC

");

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Data Antrian</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="../assets/css/style.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand">

ConsultQueue Admin

</a>

<a
href="dashboard.php"
class="btn btn-light">

Dashboard

</a>

</div>

</nav>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">

Data Antrian Konsultasi

</h4>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Nomor</th>

<th>Mahasiswa</th>

<th>Dosen</th>

<th>Hari</th>

<th>Jam</th>

<th>Status</th>

<th width="220">

Aksi

</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= date('d-m-Y',strtotime($d['tanggal'])); ?></td>

<td>

<span class="badge bg-dark">

<?= $d['nomor_antrian']; ?>

</span>

</td>

<td>

<b><?= $d['nama']; ?></b>

<br>

<small><?= $d['nim']; ?></small>

</td>

<td>

<?= $d['nama_dosen']; ?>

</td>

<td>

<?= $d['hari']; ?>

</td>

<td>

<?= substr($d['jam_mulai'],0,5); ?>

-

<?= substr($d['jam_selesai'],0,5); ?>

</td>

<td>

<?php

if($d['status']=="Menunggu"){

?>

<span class="badge bg-warning text-dark">

Menunggu

</span>

<?php

}elseif($d['status']=="Dipanggil"){

?>

<span class="badge bg-primary">

Dipanggil

</span>

<?php

}else{

?>

<span class="badge bg-success">

Selesai

</span>

<?php } ?>

</td>

<td>

<?php if($d['status']=="Menunggu"){ ?>

<a
href="?aksi=panggil&id=<?= $d['id_antrian'];?>"
class="btn btn-primary btn-sm">

<i class="bi bi-megaphone"></i>

Panggil

</a>

<?php } ?>

<?php if($d['status']=="Dipanggil"){ ?>

<a
href="?aksi=selesai&id=<?= $d['id_antrian'];?>"
class="btn btn-success btn-sm">

<i class="bi bi-check-circle"></i>

Selesai

</a>

<?php } ?>

<a
href="?hapus=<?= $d['id_antrian'];?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus data ini?')">

<i class="bi bi-trash"></i>

Hapus

</a>

</td>

</tr>

<?php } ?>

<?php if(mysqli_num_rows($data)==0){ ?>

<tr>

<td colspan="9" class="text-center">

Belum ada data antrian.

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