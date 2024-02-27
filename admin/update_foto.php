<?php

include "koneksi.php";
session_start();

$FotoID = $_POST['FotoID'];
$JudulFoto = $_POST['JudulFoto'];
$DeskripsiFoto = $_POST['DeskripsiFoto'];
$AlbumID = $_POST['AlbumID'];

if($_FILES['LokasiFile']['name'] != "") {
    $rand = rand();
    $ekstensi = array("png","jpg","jpeg","gif");
    $namafile = $_FILES['LokasiFile']['name'];
    $ukuran = $_FILES['LokasiFile']['size'];
    $ext = pathinfo($namafile, PATHINFO_EXTENSION);
    
    if(!in_array($ext, $ekstensi)) {
        echo '<script>alert("Data gagal diubah!"); window.location.href = "foto.php"</script>';
    } else {
        if($ukuran < 204488000) {
            $sql = mysqli_query($conn, "SELECT LokasiFile FROM foto WHERE FotoID='$FotoID'");
            $data = mysqli_fetch_array($sql);
            $LokasiFile = $data['LokasiFile'];
            unlink("gambar/$LokasiFile");

            $xx = $rand.'_'.$namafile;
            move_uploaded_file($_FILES['LokasiFile']['tmp_name'], 'gambar/'.$rand.'_'.$namafile);
            mysqli_query($conn, "UPDATE foto SET JudulFoto='$JudulFoto', DeskripsiFoto='$DeskripsiFoto', LokasiFile='$xx', AlbumID='$AlbumID' WHERE FotoID='$FotoID'");
            echo '<script>alert("Data berhasil diubah!"); window.location.href = "foto.php"</script>';
        } else {
            echo '<script>alert("Ukuran gambar terlalu besar!"); window.location.href = "foto.php"</script>';
        }
    }
} else {
    mysqli_query($conn, "UPDATE foto SET JudulFoto='$JudulFoto', DeskripsiFoto='$DeskripsiFoto', AlbumID='$AlbumID' WHERE FotoID='$FotoID'");
    echo '<script>alert("Data berhasil diubah!"); window.location.href = "foto.php"</script>';
}

?>