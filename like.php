<?php

include "admin/koneksi.php";
session_start();
if(!isset($_SESSION['UserID'])) {
    echo '<script>alert("harap login terlebih dahulu sebelum menyukai postingan!"); window.location.href = " login.php"</script>';
} else {
    $FotoID = $_GET['FotoID'];
    $UserID = $_SESSION['UserID'];

    $sql = mysqli_query($conn, "SELECT * FROM likefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");

    if(mysqli_num_rows($sql) == 1) {
        header("Location:index.php");
    } else {
        $TanggalLike = date("Y-m-d");
        mysqli_query($conn, "INSERT INTO likefoto VALUES('','$FotoID','$UserID','$TanggalLike')");
        header("Location:index.php");
    }
}

?>