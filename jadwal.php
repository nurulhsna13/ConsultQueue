<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

// ====================
// TAMBAH JADWAL
// ====================
if(isset($_POST['tambah'])){

    $id_dosen   = $_POST['id_dosen'];
    $hari       = $_POST['hari'];
    $jam_mulai  = $_POST['jam_mulai'];
    $jam_selesai= $_POST['jam_selesai'];

    mysqli_query($conn,"
    INSERT INTO jadwal(id_dosen,hari,jam_mulai,jam_selesai)
    VALUES('$id_dosen','$hari','$jam_mulai','$jam_selesai')
    ");

    header("Location: jadwal.php");
    exit;
}

// ====================
// HAPUS
// ====================
if(isset($_GET['hapus'])){

    $id = (int)$_GET['hapus'];

    mysqli_query($conn,"
    DELETE FROM jadwal
    WHERE id_jadwal='$id'
    ");

    header("Location: jadwal.php");
    exit;
}

// ====================
// DATA DOSEN
// ====================
$dosen = mysqli_query($conn,"
SELECT * FROM dosen
ORDER BY nama_dosen ASC
");

// ====================
// DATA JADWAL
// ====================
$data = mysqli_query($conn,"
SELECT
jadwal.*,
dosen.nama_dosen

FROM jadwal

JOIN dosen
ON jadwal.id_dosen=dosen.id_dosen

ORDER BY
FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat'),
jam_mulai
");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Jadwal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<h2>Data Jadwal</h2>

<a href="dashboard.php" class="btn btn-secondary">
Kembali
</a>

</div>

<div class="card shadow mb-4">

<div class="card-header bg-primary text-white">
Tambah Jadwal
</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-3">

<select name="id_dosen" class="form-control" required>

<option value="">Pilih Dosen</option>

<?php while($d=mysqli_fetch_assoc($dosen)){ ?>

<option value="<?= $d['id_dosen']; ?>">

<?= $d['nama_dosen']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-2">

<select name="hari" class="form-control" required>

<option>Senin</option>
<option>Selasa</option>
<option>Rabu</option>
<option>Kamis</option>
<option>Jumat</option>

</select>

</div>

<div class="col-md-2">

<input type="time"
name="jam_mulai"
class="form-control"
required>

</div>

<div class="col-md-2">

<input type="time"
name="jam_selesai"
class="form-control"
required>

</div>

<div class="col-md-3">

<button
name="tambah"
class="btn btn-primary w-100">

Tambah Jadwal

</button>

</div>

</div>

</form>

</div>

</div>

<div class="col-md-2">
    <label>Jam Mulai</label>
    <input type="time" name="jam_mulai" class="form-control" required>
</div>

<div class="col-md-2">
    <label>Jam Selesai</label>
    <input type="time" name="jam_selesai" class="form-control" required>
    
</div>

<div class="card-body">

<table class="table table-bordered">

<thead class="table-primary">

<tr>

<th>No</th>
<th>Dosen</th>
<th>Hari</th>
<th>Jam</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no=1;
while($j=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $j['nama_dosen']; ?></td>

<td><?= $j['hari']; ?></td>

<td>

<?= substr($j['jam_mulai'],0,5); ?>

-

<?= substr($j['jam_selesai'],0,5); ?>

</td>

<td>

<a
href="?hapus=<?= $j['id_jadwal']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus jadwal?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>