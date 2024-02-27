<?php

include "koneksi.php";
session_start();
if(!isset($_SESSION['UserID'])) {
    header("Location:../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.css">
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

        .foto-user-profile-nav {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .space-between-body {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar-fixed {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1;
        }

        .container-margin {
            margin-top: 100px;
        }
    </style>
</head>

<body class="space-between-body">
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark navbar-fixed">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard Gallery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="foto.php">Foto</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilihan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../index.php">Client</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="profile.php?UserID=<?= $_SESSION['UserID'] ?>" class="nav-link active" style="margin: 0; padding: 0;"><?= $_SESSION['NamaLengkap'] ?> <img src="fotouser/<?= $_SESSION['FotoUser'] ?>" alt="" class="foto-user-profile-nav"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container container-margin mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9 bg-light py-3">
                <h5 class="display-6 fw-bold text-center">Akun Saya</h5>
                <form action="update_profile.php" method="post" enctype="multipart/form-data">
                <?php
                    $UserID = $_GET['UserID'];
                    $sql = mysqli_query($conn, "SELECT * FROM user WHERE UserID='$UserID'");
                    while($data = mysqli_fetch_array($sql)) {
                ?>
                    <input type="text" class="form-control mb-2" id="UserID" name="UserID" placeholder="klik dan ketik disini..." value="<?= $data['UserID'] ?>" hidden>
                    <label for="inputFoto" style="display: block;" class="mb-3">
                        <img src="fotouser/<?= $data['FotoUser'] ?>" alt="" class="foto-user-profile" id="imgFoto">
                    </label>
                    <input type="file" name="FotoUser" id="inputFoto" class="form-control" hidden >
                    <label for="Username">Username</label>
                    <input type="text" class="form-control mb-2" id="Username" name="Username" placeholder="klik dan ketik disini..." value="<?= $data['Username'] ?>">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control mb-2" id="Password" name="Password" placeholder="klik dan ketik disini..." value="<?= $data['Password'] ?>">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control mb-2" id="Email" name="Email" placeholder="klik dan ketik disini..." value="<?= $data['Email'] ?>">
                    <label for="NamaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control mb-2" id="NamaLengkap" name="NamaLengkap" placeholder="klik dan ketik disini..." value="<?= $data['NamaLengkap'] ?>">
                    <label for="Alamat">Alamat</label>
                    <textarea name="Alamat" class="form-control mb-2" id="Alamat" cols="30" rows="5" placeholder="klik dan ketik disini..." ><?= $data['Alamat'] ?></textarea>
                    <input type="submit" value="Ubah" class="btn btn-success">
                    <button type="reset" class="btn btn-danger">Hapus</button>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                    <hr>
                    <p class="h6 text-center">Atau</p>
                    <hr>
                <?php
                    }
                ?>
                </form>
                <form action="hapus_profile.php?UserID=<?= $_SESSION['UserID'] ?>" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus secara permanent?')">
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Hapus Permanent</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary text-light text-center py-3">
        <b class="fs-6">Copyright &copy; <?= date("Y") ?> Gallery</b>
    </div>
</body>

<script src="js/image.js"></script>
<script src="js/bootstrap.js"></script>

</html>