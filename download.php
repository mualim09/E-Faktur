<?php
$host="localhost";
$db="so";
$user="root";
$pass="";

$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 
$serverName = "central";  
  
/* Connect using Windows Authentication. */  
try  
{  
$conn2 = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}



?>
<style type="text/css">
 a{
		text-decoration: none;
		
	}
	#pr{
		background-color: red;
		height: 120px;
		padding-top: 15px
	}
	#im{
		background-color: green;
		height: 120px;
		padding-top: 15px
	}
	#pr1{
		background-color: yellow;
		height: 120px;
		padding-top: 15px
	}
	#im1{
		background-color: orange;
		height: 120px;
		padding-top: 15px
	}
	#pr2{
		background-color: pink;
		height: 120px;
		padding-top: 15px
	}
	#im2{
		background-color: white;
		height: 120px;
		padding-top: 15px
	}
	#gr{
		background-color: black;
		height: 150px;
		padding-top: 15px
	}
</style>
<table border="1" width="100%">
	<tr>
		<td colspan="2">
				<center>FOOD 4 </center>
		</td>
	</tr>
	<tr align="center">
		<td><a target="_BLANK" align="center" href="sk_excel7.php" class="btn btn-danger">
			<div id="pr"><h1>Print Untuk Afi FOOD 4</h1></div></a>
		</td>
		<td><a target="_BLANK" align="center" href="sk_excel8.php" class="btn btn-primary">
			<div id="im"><h2>Excel TI-TO Proint FOOD 4</h2></div>
		</a>
	</td>
	</tr>

	<tr>
		<td colspan="2">
				<center>FOOD 3 </center>
		</td>
	</tr>
	<tr align="center">
		<td><a target="_BLANK" align="center" href="sk_excel9.php" class="btn btn-danger">
			<div id="pr1"><h1>Print Untuk Afi FOOD 3</h1></div></a>
		</td>
		<td><a target="_BLANK" align="center" href="sk_excel10.php" class="btn btn-primary">
			<div id="im1"><h2>Excel TI-TO Proint FOOD 3</h2></div>
		</a>
	</td>
	</tr>
	<tr>
		<td colspan="2">
				<center>FOOD 1 </center>
		</td>
	</tr>
	<tr align="center">
		<td><a target="_BLANK" align="center" href="sk_excel11.php" class="btn btn-danger">
			<div id="pr2"><h1>Print Untuk Afi FOOD 1</h1></div></a>
		</td>
		<td><a target="_BLANK" align="center" href="sk_excel12.php" class="btn btn-primary">
			<div id="im2"><h2>Excel TI-TO Proint FOOD 1</h2></div>
		</a>
	</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<ul>
				<li>Pastikan Download filenya bersamaan</li>
				<li>file Import proint harus langsung di import ke proint jangan tunggu transferan yang lain</li>
				<li>jika ada perubahan qty, ubahnya di proint jgn di excelnya</li>
				<li>jika lupa langkah-langkahnya bisa lihat di sini <a href="afi.pdf">click</a></li>
			</ul>
		</td>
	</tr>
</table>