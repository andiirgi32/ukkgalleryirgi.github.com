<?php

include "koneksi.php";
session_start();

$JudulFoto = $_POST['JudulFoto'];
$DeskripsiFoto = $_POST['DeskripsiFoto'];
$TanggalUnggah = date("Y-m-d");
$AlbumID = $_POST['AlbumID'];
$UserID = $_SESSION['UserID'];

$rand = rand();
$ekstensi = array("png","jpg","jpeg","gif");
$namafile = $_FILES['LokasiFile']['name'];
$ukuran = $_FILES['LokasiFile']['size'];
$ext = pathinfo($namafile, PATHINFO_EXTENSION);

if(!in_array($ext, $ekstensi)) {
    echo '<script>alert("Data gagal ditambahkan!"); window.location.href = "foto.php"</script>';
} else {
    if($ukuran < 204488000) {
        $xx = $rand.'_'.$namafile;
        move_uploaded_file($_FILES['LokasiFile']['tmp_name'], 'gambar/'.$rand.'_'.$namafile);
        mysqli_query($conn, "INSERT INTO foto VALUES('','$JudulFoto','$DeskripsiFoto','$TanggalUnggah','$xx','$AlbumID','$UserID')");
        echo '<script>alert("Data berhasil ditambahkan!"); window.location.href = "foto.php"</script>';
    } else {
        echo '<script>alert("Ukuran gambar terlalu besar!"); window.location.href = "foto.php"</script>';
    }
}

?>