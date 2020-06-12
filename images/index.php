<?php
session_start();
if (empty($_SESSION['nm_user'])) {
	
	header("location:../login.php");
}
?>