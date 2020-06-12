<?php
$id = $_GET['id']; 
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=".$id.".csv");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(0);

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





//$output = fopen('php://output', 'w');

// output the column headings

// fetch the data
 $sql = "SELECT PONmbr,POProduct,Convert(float,POStdQty) POStdQty, ProdBarcode,Convert(float,POQtyPrice) POQtyPrice FROM PRPOdt inner join SMProdBarcode ON SMProdBarcode.prodcode = PRPOdt.POProduct  WHERE PRPOdt.PONmbr='$id' And FgBarcodeDefault='Y'";

$rows = $conn->query($sql);
  // header 
echo "code_store;po_no;barcode;qty;modal_karton"."\n";
   while ($r = $rows->fetch(PDO::FETCH_ASSOC)) {
            $harga = explode(".", $r['POQtyPrice']);

       echo "402735;".$r['PONmbr'].";".$r['ProdBarcode'].";".number_format($r['POStdQty']).";".$harga[0]."\n";

 }

?>

