<?php

include "koneksi.php";
session_start();

$UserID = $_POST['UserID'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Email = $_POST['Email'];
$NamaLengkap = $_POST['NamaLengkap'];
$Alamat = $_POST['Alamat'];

if($_FILES['FotoUser']['name'] != "") {
    $rand = rand();
    $ekstensi = array("png","jpg","jpeg","gif");
    $namafile = $_FILES['FotoUser']['name'];
    $ukuran = $_FILES['FotoUser']['size'];
    $ext = pathinfo($namafile, PATHINFO_EXTENSION);
    
    if(!in_array($ext, $ekstensi)) {
        echo '<script>alert("Data gagal diubah!"); window.location.href = "login.php"</script>';
    } else {
        if($ukuran < 204488000) {
            $sql = mysqli_query($conn, "SELECT FotoUser FROM user WHERE UserID='$UserID'");
            $data = mysqli_fetch_array($sql);
            $FotoUser = $data['FotoUser'];
            unlink("fotouser/$FotoUser");

            $xx = $rand.'_'.$namafile;
            move_uploaded_file($_FILES['FotoUser']['tmp_name'], 'fotouser/'.$rand.'_'.$namafile);
            mysqli_query($conn, "UPDATE user SET Username='$Username', Password='$Password', Email='$Email', NamaLengkap='$NamaLengkap', Alamat='$Alamat', FotoUser='$xx' WHERE UserID='$UserID'");
            echo '<script>alert("Data berhasil diubah, silahkan login ulang!"); window.location.href = "index.php"</script>';
            session_destroy();
        } else {
            echo '<script>alert("Ukuran gambar terlalu besar!"); window.location.href = "../register.php"</script>';
        }
    }
} else {
    mysqli_query($conn, "UPDATE user SET Username='$Username', Password='$Password', Email='$Email', NamaLengkap='$NamaLengkap', Alamat='$Alamat' WHERE UserID='$UserID'");
    echo '<script>alert("Data berhasil diubah, silahkan login ulang!"); window.location.href = "index.php"</script>';
    session_destroy();
}

?>