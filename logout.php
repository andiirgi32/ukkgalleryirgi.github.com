<?php

include "admin/koneksi.php";
session_start();
session_destroy();
echo '<script>alert("proses logout telah berhasil, sampai jumpa!"); window.location.href = " login.php"</script>';

?>