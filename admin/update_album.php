<?php

include "koneksi.php";
session_start();

$AlbumID = $_POST['AlbumID'];
$NamaAlbum = $_POST['NamaAlbum'];
$Deskripsi = $_POST['Deskripsi'];

$sql = mysqli_query($conn, "UPDATE album SET NamaAlbum='$NamaAlbum', Deskripsi='$Deskripsi' WHERE AlbumID='$AlbumID'");

if($sql) {
    echo '<script>alert("data berhasil diubah!"); window.location.href = " album.php"</script>';
} else {
    echo '<script>alert("data gagal diubah!"); window.location.href = " album.php"</script>';
}
?>