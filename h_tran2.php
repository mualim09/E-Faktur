<?php
include_once 'koneksi.php';
 $NOMOR_FAKTUR = $_GET['NOMOR_FAKTUR'];

echo $sql = "DELETE FROM pajak WHERE NOMOR_FAKTUR='$NOMOR_FAKTUR'";

if ($conn->query($sql)) {
	echo "<script>alert('Data Berhasil Di Hapus !')</script>";
	header('location:index.php');
}

?>