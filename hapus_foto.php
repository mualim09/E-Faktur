<?php
include_once 'koneksi.php';

echo $lok = $_GET['lok'];
echo $foto = $_GET['foto'];




echo $sql = "DELETE FROM foto WHERE lok='$lok'";
unlink("images/".$foto."");


if ($conn->query($sql)) {
	
	header('location:foto.php?status=okdel');
}
else{
	header('location:foto.php?status=err');
}




?>