<?php

include "koneksi.php";
session_start();

$FotoID = $_POST['FotoID'];
$UserID = $_SESSION['UserID'];
$IsiKomentar = $_POST['IsiKomentar'];
$TanggalKomentar = date("Y-m-d");

$sql = mysqli_query($conn, "INSERT INTO komentarfoto VALUES('','$FotoID','$UserID','$IsiKomentar','$TanggalKomentar')");

header("Location:../komentar.php?FotoID=".$FotoID);
?>