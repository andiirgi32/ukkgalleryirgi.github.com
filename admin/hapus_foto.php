<?php

include "koneksi.php";
session_start();

$FotoID = $_GET['FotoID'];

$sql = mysqli_query($conn, "SELECT LokasiFile FROM foto WHERE FotoID='$FotoID'");
$data = mysqli_fetch_array($sql);
$LokasiFile = $data['LokasiFile'];
unlink("gambar/$LokasiFile");

$sql2 = mysqli_query($conn, "DELETE FROM foto WHERE FotoID='$FotoID'");

if($sql2) {
    echo '<script>alert("data berhasil dihapus!"); window.location.href = " foto.php"</script>';
} else {
    echo '<script>alert("data gagal dihapus!"); window.location.href = " foto.php"</script>';
}
?>