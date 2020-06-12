<?php
include_once 'koneksi.php';

echo $id = $_GET['id'];
echo $sku= $_GET['sku'];




echo $sql = "DELETE FROM pos_tmp WHERE id_barang='$sku' and id='$id'";

if ($conn->query($sql)) {
	
	header('location:kasir.php');
}
else{
	header('location:kasir.php');
}




?>