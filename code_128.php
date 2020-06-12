<?php
     date_default_timezone_set("Asia/Jakarta");

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


    //Include the barcode script
    
    include_once '../barcode.php';
    
    //Handle if text GETed

?>

<!DOCTYPE html>

<html lang="en-US">
	
	<head>
		
		<title>Barcode Generator</title>
		
	</head>
	
<body>
	
<!-- 	<form action="" method="GET">
		
		<input type="" name="kode" placeholder="masukan sku atau nama">
		
		<input type="submit" value="Create Barcode >" />
		
	</form> -->
	
<!-- 	<br /><br /><br /><br /> -->


	
	

<!DOCTYPE html>
<?php




$kode = "'0004980.00',
'0004981.00',
'0004975.00',
'0027557.00',
'0043868.00',
'0004978.00',
'0036127.00',
'0043867.00',
'0036131.00',
'0036129.00',
'0036128.00',
'0046763.00',
'0046764.00',
'0004921.01',
'0004918.01',
'0004925.01',
'0038044.00',
'0042392.00',
'0004923.01'";
	




$sql= "select SMPlannogramMS.prodcode as prodcode,SMProdBarcode.ProdBarcode,
ProdName,uomTrans,max_all,rakgd,jual 
from (SMPlannogramMS inner join SMProdBarcode on SMPlannogramMS.prodcode = SMProdBarcode.prodcode ) 
inner join SMProductMs on SMPlannogramMS.prodcode = SMProductMs.Prodcode 
where SMProdBarcode.FgBarcodeDefault='Y' and SMPlannogramMS.prodcode in($kode)";
	

?>
<div style="width: 900px;height: 100%;border: 1px solid black;padding:1%">
<form action="upd_barang.php">


<?php


 $hasil = $conn->query($sql);
	while($data = $hasil->fetch())
	{



?>
<div style="background-color:;display:inline-block;border:1px solid black;width:285px;height: 134px;padding: 5px;">
	<table width="285px"  border="0" cellpadding="0" style="border-collapse: collapse;">
	<tr>
                    	<td colspan="4" align="left">
                    		<strong><?php echo substr($data['ProdName'],0,25)?></strong>
                    	</td>
                    </tr>
                       <tr>
                        <td colspan="2" align="center" style="font-size: 10px">
                            <?php echo $data['ProdBarcode'];?>

                            ( <i><?php echo date('dmy');?></i> )
                        </td>
                    </tr>
                   <tr>
                         <td colspan="2" id="" align="center"><?php
                          $data['ProdBarcode'];
                         	$img			=	code128BarCode($data['ProdBarcode'], 1);
							ob_start();
							imagepng($img);
							$output_img		=	ob_get_clean();
                          if(!empty($data['ProdBarcode'])) echo '<img width="100%" height="40" src="data:image/png;base64,' . base64_encode($output_img) . '" />'; 

                            ?></td>
                         <td colspan="2" align="center"> <h3>Rp. <?php echo number_format($data['jual'])?></h3></td>
                    </tr>
                 
                    
                    <tr>
                    	<td>SKU</td><td>: <?php echo $data['prodcode'] ?> </td>
                    	<td>Uom Trans</td><td align="center">: <?php echo number_format($data['uomTrans']) ?></td>
                   
                    </tr>
                    <tr>
                    	<td>Lokasi</td><td>: <?php echo $data['rakgd'] ?> </td>
                    	<td>Max</td><td align="center">: <?php echo number_format($data['max_all'])?></td>
                   
                    </tr>
                    <tr>
                    <td></td>
                    	<td align="center" style="font-size: 10px"></td>
                    	<td></td>
                    	  <td></td>
                    </tr>
                   </table>
</div>
<?php

}

?>


                                    
</div>
</body>
	
</html>