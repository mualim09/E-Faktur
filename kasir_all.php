<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

include_once('koneksi.php');



$id = $_POST['id_pos'];
$byr =$_POST['byr'];
$user = $_SESSION['nm_user'];


echo $sql ="INSERT INTO pos_hd VALUES('$id',NOW(),NOW(),'$byr','$user')";
echo "<br>";
echo $sql2 ="INSERT INTO pos_dt (SELECT*FROM pos_tmp WHERE id='$id')";
echo "<br>";
echo $sql3 ="DELETE FROM pos_tmp WHERE id='$id'";

		    if ($conn->query($sql) && $conn->query($sql2) && $conn->query($sql3)) {
		      
		      header('location:kasir_print.php?id='.$id.'');
		      
		  }



?>