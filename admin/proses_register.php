<?php

include "koneksi.php";
session_start();

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Email = $_POST['Email'];
$NamaLengkap = $_POST['NamaLengkap'];
$Alamat = $_POST['Alamat'];

$rand = rand();
$ekstensi = array("png","jpg","jpeg","gif");
$namafile = $_FILES['FotoUser']['name'];
$ukuran = $_FILES['FotoUser']['size'];
$ext = pathinfo($namafile, PATHINFO_EXTENSION);

if(!in_array($ext, $ekstensi)) {
    echo '<script>alert("Registrasi gagal dilakukan, coba sekali lagi!"); window.location.href = "../register.php"</script>';
} else {
    if($ukuran < 204488000) {
        $xx = $rand.'_'.$namafile;
        move_uploaded_file($_FILES['FotoUser']['tmp_name'], 'fotouser/'.$rand.'_'.$namafile);
        mysqli_query($conn, "INSERT INTO user VALUES('','$Username','$Password','$Email','$NamaLengkap','$Alamat','$xx')");
        echo '<script>alert("Registrasi telah berhasil, silahkan login!"); window.location.href = "../login.php"</script>';
    } else {
        echo '<script>alert("Ukuran gambar terlalu besar!"); window.location.href = "../register.php"</script>';
    }
}

?>