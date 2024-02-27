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
    <title>Tambah Foto</title>
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
                        <a class="nav-link active" href="foto.php">Foto</a>
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

    <div class="container container-margin mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9 bg-light py-3">
                <h5 class="display-6 fw-bold text-center">Tambah Foto</h5>
                <form action="proses_foto.php" method="post" enctype="multipart/form-data">
                    <label for="JudulFoto">Judul Foto</label>
                    <input type="text" class="form-control mb-2" id="JudulFoto" name="JudulFoto" placeholder="klik dan ketik disini..." >
                    <label for="DeskripsiFoto">Deskripsi Foto</label>
                    <textarea name="DeskripsiFoto" id="DeskripsiFoto" cols="30" rows="5" class="form-control mb-2" placeholder="klik dan ketik disini..."></textarea>
                    <label for="inputFoto" style="display: block;">Foto</label>
                    <img src="" alt="" id="imgFoto" width="200px" class="mb-1">
                    <input type="file" class="form-control mb-2" id="inputFoto" name="LokasiFile" placeholder="klik dan ketik disini..." >
                    <label for="AlbumID">Album</label>
                    <select name="AlbumID" id="AlbumID" class="form-control mb-2">
                    <?php
                        $UserID = $_SESSION['UserID'];
                        $sql = mysqli_query($conn, "SELECT * FROM album WHERE UserID='$UserID'");
                        while($data = mysqli_fetch_array($sql)) {
                    ?>
                        <option value="<?= $data['AlbumID'] ?>"><?= $data['NamaAlbum'] ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <input type="submit" value="Tambah" class="btn btn-success">
                    <button type="reset" class="btn btn-danger">Hapus</button>
                    <a href="foto.php" class="btn btn-warning">Kembali</a>
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