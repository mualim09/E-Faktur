<?php
include_once 'koneksi.php';

echo $a = $_GET['bar'];




echo $sql = "DELETE FROM pajak WHERE NOMOR_FAKTUR='$a'";


if ($conn->query($sql)) {
	
	header('location:pajak.php?pesan=Sudah Di Hapus !');
}
else{
	header('location:pajak.php?pesan=err');
}




?>