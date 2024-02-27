<?php

include "koneksi.php";
session_start();

$AlbumID = $_GET['AlbumID'];

$sql = mysqli_query($conn, "DELETE FROM album WHERE AlbumID='$AlbumID'");

if($sql) {
    echo '<script>alert("data berhasil dihapus!"); window.location.href = " album.php"</script>';
} else {
    echo '<script>alert("data gagal dihapus!"); window.location.href = " album.php"</script>';
}
?>