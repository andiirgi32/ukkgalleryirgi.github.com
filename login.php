<?php

include "admin/koneksi.php";
session_start();
if(isset($_SESSION['UserID'])) {
    header("Location:admin/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="admin/css/bootstrap.css">
    <style>
        .foto-user-profile {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9 bg-light py-3">
                <h5 class="display-6 fw-bold text-center">Login</h5>
                <form action="admin/proses_login.php" method="post" enctype="multipart/form-data">
                    <label for="Username">Username</label>
                    <input type="text" class="form-control mb-2" id="Username" name="Username" placeholder="klik dan ketik disini..." >
                    <label for="Password">Password</label>
                    <input type="password" class="form-control mb-2" id="Password" name="Password" placeholder="klik dan ketik disini..." >
                    <input type="submit" value="Login" class="btn btn-success">
                    <button type="reset" class="btn btn-danger">Hapus</button>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="admin/js/image.js"></script>
<script src="admin/js/bootstrap.js"></script>
</html>