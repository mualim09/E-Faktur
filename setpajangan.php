<?php
include_once 'koneksi.php';



$sql = "INSERT INTO afi(id) SELECT DISTINCT sku FROM lokasi WHERE sku NOT IN (SELECT id FROM afi)";
$sql2 ="UPDATE afi SET `avg`=1,kel=1,`max`=1 WHERE `avg`IS NULL AND kel IS NULL";


if ($conn->query($sql) && $conn->query($sql2)) {
	
	header('location:index.php?status=ok');
}
else{
	header('location:index.php?status=err');
}




?>