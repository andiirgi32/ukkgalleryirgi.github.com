<?php

include "admin/koneksi.php";
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
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

        .foto-user-profile-nav {
            width: 30px;
            height: 30px;
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

        .space-between-card {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            height: 100%;
        }
    </style>
</head>

<body class="space-between-body">
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark navbar-fixed">
        <div class="container">
            <a class="navbar-brand" href="#">Gallery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php
                        if(isset($_SESSION['UserID'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index.php">Dashboard</a>
                    </li>
                    <?php
                        }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilihan
                        </a>
                        <?php
                            if(isset($_SESSION['UserID'])) {
                        ?>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </ul>
                        <?php
                            } else {
                        ?>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="register.php">Register</a></li>
                        </ul>
                        <?php
                            }
                        ?>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php
                        if(isset($_SESSION['UserID'])) {
                    ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="admin/profile.php?UserID=<?= $_SESSION['UserID'] ?>" class="nav-link" style="margin: 0; padding: 0;"><?= $_SESSION['NamaLengkap'] ?> <img src="admin/fotouser/<?= $_SESSION['FotoUser'] ?>" alt="" class="foto-user-profile-nav"></a>
                        </li>
                    </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container container-margin bg-light py-3 mb-5">
        <div class="row">
            <?php
                $sql = mysqli_query($conn, "SELECT * FROM foto,album,user WHERE foto.UserID=user.UserID AND foto.AlbumID=album.AlbumID");
                while($data = mysqli_fetch_array($sql)) {
            ?>
            <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
                <div class="card space-between-card">
                    <img src="admin/gambar/<?= $data['LokasiFile'] ?>" alt="" class="card-img-top">
                    <div class="card-header">
                        <h5 class="card-title"><?= $data['JudulFoto'] ?></h5>
                        <h6 class="card-subtitle">Oleh: <?= $data['NamaLengkap'] ?> | Dipublish: <?= $data['TanggalUnggah'] ?></h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $data['DeskripsiFoto'] ?>
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Album: <?= $data['NamaAlbum'] ?></li>
                    </ul>
                    <div class="card-footer">
                        <a href="like.php?FotoID=<?= $data['FotoID'] ?>" class="btn btn-danger">
                            Like | 
                            <?php
                                $FotoID = $data['FotoID'];
                                $like = mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$FotoID'");
                                echo mysqli_num_rows($like);
                            ?>
                        </a>
                        <a href="komentar.php?FotoID=<?= $data['FotoID'] ?>" class="btn btn-warning">
                            Komentar | 
                            <?php
                                $komentar = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE FotoID='$FotoID'");
                                echo mysqli_num_rows($komentar);
                            ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="container-fluid bg-primary text-light text-center py-3">
        <b class="fs-6">Copyright &copy; <?= date("Y") ?> Gallery</b>
    </div>
</body>

<script src="admin/js/image.js"></script>
<script src="admin/js/bootstrap.js"></script>

</html>