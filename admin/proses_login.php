<?php

include "koneksi.php";
session_start();

$Username = $_POST['Username'];
$Password = $_POST['Password'];

$sql = mysqli_query($conn, "SELECT * FROM user WHERE Username='$Username' AND Password='$Password'");

$cek = mysqli_num_rows($sql);

if ($cek == 1) {
    while ($data = mysqli_fetch_array($sql)) {
        $_SESSION['UserID'] = $data['UserID'];
        $_SESSION['NamaLengkap'] = $data['NamaLengkap'];
        $_SESSION['FotoUser'] = $data['FotoUser'];
    }
    echo '<script>alert("proses login telah berhasil, selamat datang!"); window.location.href = " index.php"</script>';
} else {
    echo '<script>alert("proses login gagal dilakukan, silahkan coba lagi!"); window.location.href = " ../login.php"</script>';
}
