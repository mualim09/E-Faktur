<?php
include_once 'koneksi.php';


$sk = $_GET['sk'];
$sku = $_GET['sku'];
$e = $_GET['ket'];
$f = $_GET['upd'];
$g = $_GET['tgl'];


		echo $sql = "DELETE FROM so WHERE sk='$sk' and ket='$e' and sku='$sku' and upd='$f' and tgl='$g'";

			if ($conn->query($sql)) {
				
				header('location:../so/list_so_lihat.php?id='.$e.'');
			}



?>