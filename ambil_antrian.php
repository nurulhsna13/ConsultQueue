<?php
session_start();
include "config/koneksi.php";

if(!isset($_SESSION['mahasiswa'])){
    header("Location: login.php");
    exit;
}

$id_mahasiswa = $_SESSION['mahasiswa'];

$id_jadwal_default = "";

if(isset($_GET['id_jadwal'])){
    $id_jadwal_default = $_GET['id_jadwal'];
}

if(isset($_POST['ambil'])){

    $id_jadwal = $_POST['id_jadwal'];
    $tanggal = date("Y-m-d");

    $cek = mysqli_query($conn,"
    SELECT MAX(nomor_antrian) AS nomor
    FROM antrian
    WHERE id_jadwal='$id_jadwal'
    AND tanggal='$tanggal'
    ");

    $hasil = mysqli_fetch_assoc($cek);

    if($hasil['nomor']==NULL){
        $nomor = 1;
    }else{
        $nomor = $hasil['nomor'] + 1;
    }

    mysqli_query($conn,"
    INSERT INTO antrian
    (
        id_mahasiswa,
        id_jadwal,
        tanggal,
        nomor_antrian,
        status
    )
    VALUES
    (
        '$id_mahasiswa',
        '$id_jadwal',
        '$tanggal',
        '$nomor',
        'Menunggu'
    )
    ");

    echo "<script>
    alert('Nomor Antrian Anda : $nomor');
    window.location='riwayat.php';
    </script>";

    exit;
}

$data = mysqli_query($conn,"
SELECT
jadwal.*,
dosen.nama_dosen

FROM jadwal

JOIN dosen
ON jadwal.id_dosen=dosen.id_dosen

ORDER BY
FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat'),
jam_mulai ASC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ambil Antrian</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    
<?php include "includes/navbar.php"; ?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">

Ambil Nomor Antrian

</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label">

Pilih Jadwal Konsultasi

</label>

<select
name="id_jadwal"
class="form-select"
required>

<option value="">-- Pilih Jadwal --</option>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<option
value="<?= $d['id_jadwal'];?>"
<?= ($id_jadwal_default==$d['id_jadwal']) ? 'selected' : ''; ?>>

<?= $d['nama_dosen']; ?>

|

<?= $d['hari']; ?>

|

<?= substr($d['jam_mulai'],0,5); ?>

-

<?= substr($d['jam_selesai'],0,5); ?>

</option>

<?php } ?>

</select>

</div>

<div class="d-grid">

<button
type="submit"
name="ambil"
class="btn btn-primary">

<i class="bi bi-ticket-perforated"></i>

Ambil Nomor Antrian

</button>

</div>

</form>

<hr>

<h5>Daftar Jadwal Konsultasi</h5>

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th>No</th>

<th>Dosen</th>

<th>Hari</th>

<th>Jam</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

mysqli_data_seek($data,0);

while($d = mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama_dosen']; ?></td>

<td>

<span class="badge bg-primary">

<?= $d['hari']; ?>

</span>

</td>

<td>

<?= substr($d['jam_mulai'],0,5); ?>

-

<?= substr($d['jam_selesai'],0,5); ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<div class="alert alert-info mt-4">

<h5>

<i class="bi bi-info-circle"></i>

Informasi

</h5>

<ul class="mb-0">

<li>Silakan pilih jadwal dosen terlebih dahulu.</li>

<li>Nomor antrian dibuat otomatis sesuai urutan pada tanggal yang sama.</li>

<li>Datang sesuai hari dan jam konsultasi.</li>

<li>Status antrian dapat dilihat pada menu <b>Riwayat</b>.</li>

</ul>

</div>

<div class="mt-3">

<a
href="../ambil_antrian.php?id_jadwal=<?= $d['id_jadwal']; ?>"

<i class="bi bi-arrow-left"></i>

Lihat Jadwal

</a>

<a
href="dashboard.php"
class="btn btn-dark">

Dashboard

</a>

</div>

</div>

</div>

</div>

<script src="assets/js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>