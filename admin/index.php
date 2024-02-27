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
    <title>Dashboard</title>
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

        .foto-user-profile-utama {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            object-fit: cover;
            /* position: relative;
            left: 50%;
            transform: translateX(-50%); */
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

        .space-between-card {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            height: 100%;
        }

        .container-grid {
            display: grid;
            grid-template-areas: 'tentang-akun''semua-post';
        }

        .tentang-akun {
            grid-area: tentang-akun;
        }

        .semua-post {
            grid-area: semua-post;
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
                        <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
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
                            <a href="profile.php?UserID=<?= $_SESSION['UserID'] ?>" class="nav-link" style="margin: 0; padding: 0;"><?= $_SESSION['NamaLengkap'] ?> <img src="fotouser/<?= $_SESSION['FotoUser'] ?>" alt="" class="foto-user-profile-nav"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container container-grid container-margin bg-light py-3 mb-5">
        <div class="row semua-post">
            <?php
                $UserID = $_SESSION['UserID'];
                $sql = mysqli_query($conn, "SELECT * FROM foto,album WHERE foto.UserID='$UserID' AND foto.AlbumID=album.AlbumID");
                $totalSemuaLike = 0;
                while($data = mysqli_fetch_array($sql)) {
                    $FotoID = $data['FotoID'];
                    $sql2 = mysqli_query($conn, "SELECT COUNT(*) AS totallike FROM likefoto WHERE FotoID='$FotoID'");
                    $row2 = mysqli_fetch_array($sql2);
                    $totallike = $row2['totallike'];
                    $totalSemuaLike += $totallike;
                    $sql3 = mysqli_query($conn, "SELECT COUNT(*) AS totalpost FROM foto,album WHERE foto.UserID='$UserID' AND foto.AlbumID=album.AlbumID");
                    $row3 = mysqli_fetch_array($sql3);
                    $totalPost = $row3['totalpost'];
            ?>
            <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
                <div class="card space-between-card">
                    <img src="gambar/<?= $data['LokasiFile'] ?>" alt="" class="card-img-top">
                    <div class="card-header">
                        <h5 class="card-title"><?= $data['JudulFoto'] ?></h5>
                        <h6 class="card-subtitle">Oleh: <?= $_SESSION['NamaLengkap'] ?> | Dipublish: <?= $data['TanggalUnggah'] ?></h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $data['DeskripsiFoto'] ?>
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Album: <?= $data['NamaAlbum'] ?></li>
                        <li class="list-group-item">
                            <a href="edit_album.php?AlbumID=<?= $data['AlbumID'] ?>" class="btn btn-primary">Edit Album</a>
                            <a href="edit_foto.php?FotoID=<?= $data['FotoID'] ?>" class="btn btn-primary">Edit Foto</a>
                        </li>
                    </ul>
                    <div class="card-footer">
                        <a href="../like.php?FotoID=<?= $data['FotoID'] ?>" class="btn btn-danger">
                            Like | 
                            <?php
                                $FotoID = $data['FotoID'];
                                $like = mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$FotoID'");
                                echo mysqli_num_rows($like);
                            ?>
                        </a>
                        <a href="../komentar.php?FotoID=<?= $data['FotoID'] ?>" class="btn btn-warning">
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
        <div class="tentang-akun text-center">
            <img src="fotouser/<?= $_SESSION['FotoUser'] ?>" alt="" class="foto-user-profile-utama">
            <h5 class="card-title">
                <?= $_SESSION['NamaLengkap'] ?>
            </h5>
            <p>Total Semua Like: <b><?= $totalSemuaLike ?></b><br>
                <?php
                    if(isset($totalPost)) {
                ?>
                Total Semua Post: <b><?= $totalPost ?></b></p>
                <?php
                    } else {
                ?>
                Total Semua Post: <b>0</b></p>
                <?php
                    }
                ?>
        </div>
    </div>

    <div class="container-fluid bg-primary text-light text-center py-3">
        <b class="fs-6">Copyright &copy; <?= date("Y") ?> Gallery</b>
    </div>
</body>


<script src="js/image.js"></script>
<script src="js/bootstrap.js"></script>

</html>
