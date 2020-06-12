<?php
include_once 'koneksi.php';

$id = $_GET['id'];


		echo $sql = "DELETE FROM bar2 WHERE bar='$id'";

			if ($conn->query($sql)) {
				
				header('location:scan.php');
			}



?>