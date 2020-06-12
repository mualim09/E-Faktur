<?php
session_start();
require_once('koneksi.php');
date_default_timezone_set("Asia/Jakarta");

if (!empty($_POST['nm_user']) && !empty($_POST['pass'])) {

		
							echo $nm   = $_POST['nm_user']; //result from POST your nm_user
							echo $pass = sha1($_POST['pass']); //use SHA1 to Encrypt yout pass;
							
				
							
								$sql = "SELECT*FROM master_user WHERE nm_user= ? and pass=?";
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$q = $conn->prepare($sql);
								$q->execute(array($nm,$pass));
								$data = $q->fetch(PDO::FETCH_ASSOC);
									
								
									echo $a = $data['nm_user'];
									echo $b = $data['pass'];
								

							



											if ($a == $nm && $b == $pass ) 
											{
														$_SESSION['nm_user'] =$nm;
														
														$_SESSION['kd']      =$data['kd_user'];
														$_SESSION['nm_lengkap'] = $data['nm_lengkap'];
														$_SESSION['level'] = $data['level'];
														$_SESSION['time']    =date('H:i:s');

														header("Location: index.php");
											}
											else {
												
												header("Location: login.php?status=bad");
										}
						
							
						


} 


else {
	header("location:login.php?status=bad");


}






?>