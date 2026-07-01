<?php
session_start();
include "config/koneksi.php";

if(!isset($_SESSION['mahasiswa'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['mahasiswa'];

$query = mysqli_query($conn,"
SELECT
antrian.*,
dosen.nama_dosen,
jadwal.hari,
jadwal.jam_mulai,
jadwal.jam_selesai

FROM antrian

JOIN jadwal
ON antrian.id_jadwal=jadwal.id_jadwal

JOIN dosen
ON jadwal.id_dosen=dosen.id_dosen

WHERE antrian.id_mahasiswa='$id'

ORDER BY antrian.id_antrian DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Riwayat Antrian</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include "includes/navbar.php"; ?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>Riwayat Konsultasi</h4>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Dosen</th>

<th>Hari</th>

<th>Jam</th>

<th>No Antrian</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['tanggal']; ?></td>

<td><?= $d['nama_dosen']; ?></td>

<td><?= $d['hari']; ?></td>

<td>

<?= substr($d['jam_mulai'],0,5); ?>

-

<?= substr($d['jam_selesai'],0,5); ?>

</td>

<td><?= $d['nomor_antrian']; ?></td>

<td>

<?php

if($d['status']=="Menunggu"){

echo "<span class='badge bg-warning'>Menunggu</span>";

}elseif($d['status']=="Dipanggil"){

echo "<span class='badge bg-primary'>Dipanggil</span>";

}else{

echo "<span class='badge bg-success'>Selesai</span>";

}

?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>