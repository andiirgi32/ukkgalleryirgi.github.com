<?php

include "koneksi.php";
session_start();

$NamaAlbum = $_POST['NamaAlbum'];
$Deskripsi = $_POST['Deskripsi'];
$TanggalDibuat = date("Y-m-d");
$UserID = $_SESSION['UserID'];

$sql = mysqli_query($conn, "INSERT INTO album VALUES('','$NamaAlbum','$Deskripsi','$TanggalDibuat','$UserID')");

if($sql) {
    echo '<script>alert("data berhasil ditambahkan!"); window.location.href = " album.php"</script>';
} else {
    echo '<script>alert("data gagal ditambahkan!"); window.location.href = " album.php"</script>';
}
?>