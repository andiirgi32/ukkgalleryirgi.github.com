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
    <title>Foto</title>
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

    <div class="container container-margin bg-light py-3 mb-5">
        <h6 class="display-6 fw-bold">Foto</h6>
        <a href="tambah_foto.php" class="btn btn-primary mb-2">Tambah</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Tanggal</th>
                    <th>Album</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Tanggal</th>
                    <th>Album</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                    $UserID = $_SESSION['UserID'];
                    $sql = mysqli_query($conn, "SELECT * FROM foto,album WHERE foto.UserID='$UserID' AND foto.AlbumID=album.AlbumID");
                    $no = 1;
                    while($data = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['JudulFoto'] ?></td>
                    <td><?= $data['DeskripsiFoto'] ?></td>
                    <td><img src="gambar/<?= $data['LokasiFile'] ?>" alt="<?= $data['JudulFoto'] ?>" width="200px"></td>
                    <td><?= $data['TanggalUnggah'] ?></td>
                    <td><?= $data['NamaAlbum'] ?></td>
                    <td width="150px">
                        <a href="edit_foto.php?FotoID=<?= $data['FotoID'] ?>" class="btn btn-warning">Edit</a>
                        <form action="hapus_foto.php?FotoID=<?= $data['FotoID'] ?>" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapusnya?')" style="display: inline;">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container-fluid bg-primary text-light text-center py-3">
        <b class="fs-6">Copyright &copy; <?= date("Y") ?> Gallery</b>
    </div>
</body>

<script src="js/image.js"></script>
<script src="js/bootstrap.js"></script>

</html>