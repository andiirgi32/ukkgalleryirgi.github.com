<?php

include "admin/koneksi.php";
session_start();
if(!isset($_SESSION['UserID'])) {
    echo '<script>alert("harap login terlebih dahulu sebelum mengomentari postingan!"); window.location.href = " login.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar</title>
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

        .foto-user-profile-komentar {
            width: 25px;
            height: 25px;
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
                    if (isset($_SESSION['UserID'])) {
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
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php
                    if (isset($_SESSION['UserID'])) {
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

    <div class="container container-margin bg-light mb-5 py-3">
        <h5 class="display-6 fw-bold text-center">Komentar</h5>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="admin/proses_komentar.php" method="post" enctype="multipart/form-data">
                    <?php
                    $FotoID = $_GET['FotoID'];
                    $sql = mysqli_query($conn, "SELECT * FROM foto WHERE FotoID='$FotoID'");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <input type="text" class="form-control mb-2" id="FotoID" name="FotoID" placeholder="klik dan ketik disini..." value="<?= $data['FotoID'] ?>" hidden>
                        <label for="JudulFoto">Judul Foto</label>
                        <p class="form-control mb-2"><?= $data['JudulFoto'] ?></p>
                        <label for="DeskripsiFoto">Deskripsi Foto</label>
                        <p class="form-control mb-2"><?= $data['DeskripsiFoto'] ?></p>
                        <label for="inputFoto" style="display: block;">Foto</label>
                        <img src="admin/gambar/<?= $data['LokasiFile'] ?>" alt="<?= $data['JudulFoto'] ?>" id="imgFoto" width="200px" class="mb-1" style="display: block;">
                        <label for="IsiKomentar">Komentar</label>
                        <textarea name="IsiKomentar" id="IsiKomentar" cols="30" rows="5" class="form-control mb-2" placeholder="klik dan ketik disini..."></textarea>
                        <input type="submit" value="Kirim" class="btn btn-success">
                        <button type="reset" class="btn btn-danger">Hapus</button>
                        <a href="index.php" class="btn btn-warning">Kembali</a>
                    <?php
                    }
                    ?>
                </form>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Komentar</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Komentar</th>
                            <th>Tanggal</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql2 = mysqli_query($conn, "SELECT * FROM komentarfoto,user WHERE komentarfoto.FotoID='$FotoID' AND komentarfoto.UserID=user.UserID");
                        while ($data = mysqli_fetch_array($sql2)) {
                        ?>
                            <tr>
                                <td><?= $data['KomentarID'] ?></td>
                                <td><img src="admin/fotouser/<?= $data['FotoUser'] ?>" alt="" class="foto-user-profile-komentar"></td>
                                <td><?= $data['NamaLengkap'] ?></td>
                                <td><?= $data['IsiKomentar'] ?></td>
                                <td><?= $data['TanggalKomentar'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary text-light text-center py-3">
        <b class="fs-6">Copyright &copy; <?= date("Y") ?> Gallery</b>
    </div>
</body>

<script src="admin/js/image.js"></script>
<script src="admin/js/bootstrap.js"></script>

</html>