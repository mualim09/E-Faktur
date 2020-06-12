<?php

$serverName = "central";  
/* Connect using Windows Authentication. */  
try  
{  
$conn = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}


$id = $_GET['id'];
$ket = $_GET['ket'];

echo $sql ="update WHTransdt set transDesc='$ket' WHERE TransNmbr ='$id'";



if ($conn->query($sql)) {
	header('location:out.php?status=ok');
}
else{
	header('location:out.php?status=err');
}



?>