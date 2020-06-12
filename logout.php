<?php
session_start();

if (isset($_SESSION['nm_user'])) 
	{
	
		unset($_SESSION['nm_user']);

		header('location:login.php');
	}





?>