<?php
session_start();
include "config/koneksi.php";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // ==========================
    // LOGIN MAHASISWA
    // ==========================
    if($role=="mahasiswa"){

        $query = mysqli_query($conn,"
            SELECT *
            FROM mahasiswa
            WHERE nim='$username'
        ");

        if(mysqli_num_rows($query)>0){

            $data = mysqli_fetch_assoc($query);

            // Password biasa
            if($password == $data['password']){

                $_SESSION['mahasiswa'] = $data['id_mahasiswa'];
                $_SESSION['nama'] = $data['nama'];

                header("Location: dashboard.php");
                exit;

            }

            // Password MD5
            if(md5($password) == $data['password']){

                $_SESSION['mahasiswa'] = $data['id_mahasiswa'];
                $_SESSION['nama'] = $data['nama'];

                header("Location: dashboard.php");
                exit;

            }

            // Password password_hash()
            if(password_verify($password,$data['password'])){

                $_SESSION['mahasiswa'] = $data['id_mahasiswa'];
                $_SESSION['nama'] = $data['nama'];

                header("Location: dashboard.php");
                exit;

            }

            echo "<script>
            alert('Password Salah!');
            </script>";

        }else{

            echo "<script>
            alert('NIM Tidak Ditemukan!');
            </script>";

        }

    }

    // ==========================
    // LOGIN ADMIN
    // ==========================
    else{

        $query = mysqli_query($conn,"
            SELECT *
            FROM admin
            WHERE username='$username'
        ");

        if(mysqli_num_rows($query)>0){

            $data = mysqli_fetch_assoc($query);

            if(
                $password == $data['password'] ||
                md5($password) == $data['password'] ||
                password_verify($password,$data['password'])
            ){

                $_SESSION['admin']=true;

                header("Location: admin/dashboard.php");
                exit;

            }else{

                echo "<script>
                alert('Password Admin Salah!');
                </script>";

            }

        }else{

            echo "<script>
            alert('Username Admin Tidak Ditemukan!');
            </script>";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | ConsultQueue</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header bg-primary text-white text-center">

<h3>LOGIN</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label">Login Sebagai</label>

<select name="role" class="form-select" required>

<option value="mahasiswa">Mahasiswa</option>

<option value="admin">Admin</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">NIM / Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="d-grid">

<button
type="submit"
name="login"
class="btn btn-primary">

Login

</button>

</div>

</form>

<hr>

<div class="text-center">

<p class="mb-2">

Belum punya akun?

<a href="register.php">

Daftar Sekarang

</a>

</p>

<p>

<a href="index.php" class="text-decoration-none">

← Kembali ke Beranda

</a>

</p>

</div>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>