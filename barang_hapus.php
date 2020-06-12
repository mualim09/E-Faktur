<?php
include_once 'koneksi.php';

echo $a = $_GET['id'];




echo $sql = "DELETE FROM barang WHERE sku='$a'";

if ($conn->query($sql)) {
	
	header('location:barang.php?status=okdel');
}
else{
	header('location:barang.php?status=err');
}




?>