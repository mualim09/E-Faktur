<?php
include_once 'koneksi.php';

echo $a = $_GET['id'];




echo $sql = "DELETE FROM master_user WHERE kd_user='$a'";

if ($conn->query($sql)) {
	
	header('location:user.php?status=okdel');
}
else{
	header('location:user.php?status=err');
}




?>