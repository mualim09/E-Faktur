<?php
include_once 'koneksi.php';


$id = $_GET['id'];
$sk = $_GET['sk'];
$wr = $_GET['wr'];


		echo $sql = "DELETE FROM so WHERE ket='$id' and sk='$sk' and wr='$wr'";

			if ($conn->query($sql)) {
				
				header('location:list_so.php?cari='.$sk.'');
			}



?>