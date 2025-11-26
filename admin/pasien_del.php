<?php
include_once("../library/koneksi.php");
$nmr = $_GET['nmr'];

mysqli_query($koneksi, "DELETE FROM pasien WHERE no_rm='$nmr'");
echo "<script>alert('Pasien berhasil dihapus');document.location='?menu=pasien';</script>";
?>
