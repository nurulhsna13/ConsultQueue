<?php
include "config/koneksi.php";

if(isset($_POST['daftar'])){

    $nim = mysqli_real_escape_string($conn,$_POST['nim']);
    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $prodi = mysqli_real_escape_string($conn,$_POST['prodi']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn,"
    SELECT * FROM mahasiswa
    WHERE nim='$nim'
    OR email='$email'
    ");

    if(mysqli_num_rows($cek)>0){

        echo "<script>
        alert('NIM atau Email sudah terdaftar!');
        </script>";

    }else{

        $simpan = mysqli_query($conn,"
        INSERT INTO mahasiswa
        (nim,nama,prodi,email,password)
        VALUES
        ('$nim','$nama','$prodi','$email','$password')
        ");

        if($simpan){

            echo "<script>
            alert('Registrasi Berhasil');
            window.location='login.php';
            </script>";

        }else{

            echo "<script>
            alert('Registrasi Gagal');
            </script>";

        }

    }

}
?>
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success text-white text-center">

<h3>REGISTRASI MAHASISWA</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>NIM</label>

<input
type="text"
name="nim"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Program Studi</label>

<input
type="text"
name="prodi"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="d-grid">

<button
type="submit"
name="daftar"
class="btn btn-success">

Daftar

</button>

</div>

</form>

<hr>

<div class="text-center">

Sudah punya akun?

<a href="login.php">

Login

</a>

</div>

<div class="text-center mt-2">

<a href="index.php">

← Kembali ke Beranda

</a>

</div>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>