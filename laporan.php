<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

$data = mysqli_query($conn,"
SELECT
antrian.*,
mahasiswa.nim,
mahasiswa.nama,
dosen.nama_dosen,
jadwal.hari,
jadwal.jam_mulai,
jadwal.jam_selesai

FROM antrian

JOIN mahasiswa
ON antrian.id_mahasiswa = mahasiswa.id_mahasiswa

JOIN jadwal
ON antrian.id_jadwal = jadwal.id_jadwal

JOIN dosen
ON jadwal.id_dosen = dosen.id_dosen

ORDER BY antrian.tanggal DESC,
antrian.nomor_antrian ASC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laporan Antrian</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

@media print{

.btn{
display:none;
}

}

</style>

</head>

<body>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<h2>Laporan Antrian Konsultasi</h2>

<div>

<button
onclick="window.print()"
class="btn btn-success">

Cetak

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>No</th>

<th>Tanggal</th>

<th>NIM</th>

<th>Mahasiswa</th>

<th>Dosen</th>

<th>Hari</th>

<th>Jam</th>

<th>No Antrian</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

while($d = mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['tanggal']; ?></td>

<td><?= $d['nim']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['nama_dosen']; ?></td>

<td><?= $d['hari']; ?></td>

<td>

<?= substr($d['jam_mulai'],0,5); ?>

-

<?= substr($d['jam_selesai'],0,5); ?>

</td>

<td><?= $d['nomor_antrian']; ?></td>

<td><?= $d['status']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>