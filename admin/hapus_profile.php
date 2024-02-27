<?php

include "koneksi.php";
session_start();

$UserID = $_GET['UserID'];

$sql = mysqli_query($conn, "SELECT FotoUser FROM user WHERE UserID='$UserID'");
$data = mysqli_fetch_array($sql);
$FotoUser = $data['FotoUser'];
unlink("fotouser/$FotoUser");

$sql2 = mysqli_query($conn, "DELETE FROM user WHERE UserID='$UserID'");

if($sql2) {
    echo '<script>alert("data berhasil dihapus permanent!"); window.location.href = " index.php"</script>';
    session_destroy();
} else {
    echo '<script>alert("data gagal dihapus permanent!"); window.location.href = " index.php"</script>';
}
?>