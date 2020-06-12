<?php
// untuk FOOD 4 Print
set_time_limit(0);
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
$kjam = date('H');
$ktgl = date('ymd');

$kodeE = "FD4".$ktgl."-".$kjam;

// header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=print-".$kodeE.".xls");//ganti nama sesuai keperluan
// header("Pragma: no-cache");
// header("Expires: 0");



$host="localhost";
$db="so";
$user="root";
$pass="";

$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$serverName = "central";  
  
/* Connect using Windows Authentication. */  
try  
{  
$conn2 = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage()));   
}

    
  // $no=1;
  // $now = '2017-09-30';//date('Y-m-d');
  $sql2 ="select segCode ,segDesc, segLevel from dbo.SMSKUdt where segLevel='7'";
  $hasil2 = $conn2->query($sql2);
                
                
 
               
                
?>

 <style type="text/css">
  
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
<h2><?php echo $kodeE?></h2>
  <table border="1">
      <thead>
       <tr>
        <th width="3%">Segment</th>
        <th width="6%">SKU</th>
        <th width="7%">Barcode</th>
         <th>Nama</th>
         <th width="3%">GD</th>
         <th width="3%">TK</th>
         <th width="3%">Max</th>
         <th width="3%">Kirim</th>
         <th width="3%">UOM</th>
         <th width="3%">Cek</th>
         <!-- <th>Uom</th>
         <th>AVG</th>
         <th>MAX</th>
         <th>MIN</th>
         <th>KIRIM PER_DAY</th> -->
         <!-- <th>GD</th> -->
         <!-- <th>TOKO</th> -->
         <!-- <th>Need</th> -->
        
         
<!--          <th data-priority="3">Avrerage</th>
         <th data-priority="1"><abbr title="Rotten Tomato Rating">Max</abbr></th> -->
       </tr>
     </thead>
     <tbody>

     <?php 
     

  $no=1;

  $sql="SELECT sku,SUM(`max`) as max FROM lokasi where sku='0003840.03' GROUP BY sku ORDER BY sku";
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {

    //sku

 $sku   =  $data['sku'];

  // untuk max
                 !empty($data['max'])?$data['max']:'';
                  $max=$data['max'];

// untuk kelipatan
                  $kel = $conn->query("select kel from afi where id='$sku' limit 1")->fetch();
$kel = $kel['kel'];
//untuk barcode barang
        $sqlbarangB = "select top 1 ProdBarcode from dbo.SMProdBarcode where fgBarcodeDefault='Y' and prodcode= '$sku'";
        $barangB = $conn2->query($sqlbarangB)->fetch();
          $barcode = $barangB['ProdBarcode'];

//untuk nama barang dan uom
          $sqlbarang = "select top 1 * from SmProductMs where prodcode='$sku'";
        $barang = $conn2->query($sqlbarang)->fetch();
        $nama = $barang['ProdName'];
        $uom = $barang['ProdUOM'];
// untuk segment
        $sqlbarangS = "select top 1 SegDesc,SMSKUdt.SegCode 
from (SMProdField inner join smproductms on smproductms.prodcode = SMProdField.prodcode)
inner join SMSKUdt on SMSKUdt.segcode = SMProdField.segcode where SMProdField.prodcode='$sku'
";
        $barangS = $conn2->query($sqlbarangS)->fetch();
         $segment = substr($barangS['SegCode'], 0,8);
         $segment2 = substr($barangS['SegDesc'], 0,5);

//untuk min
             $op =5;$lt=2;
             $konstanta = $max/(($op+$lt)*2);
             $min = ($op+(2*$lt))*$konstanta;
              $min = ceil($min);

//untuk kirim per-day
             $jml = number_format($avg/$max,3);


//untuk gudang
             $sqlbarangG = "select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='002'";
        $barangG = $conn2->query($sqlbarangG)->fetch();
        $gudang = $barangG['ProdQty'];

//untuk toko

      $sqlbarangT = "select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='001'";
             $barangT = $conn2->query($sqlbarangT)->fetch();
          $toko = $barangT['ProdQty'];
  //untuk needs

          if ($toko <= $min) {
            
           $need = $max-$toko;
           $need = round($need/$kel)*$kel;

           $status ='class="bg-success"';
      }
      else{

        $need=0;
        $status ='class="bg-default"';
      }

      //untuk kirim


      if ($need >= $gudang) {
            
           $kirim = $gudang;      }
      else{

           $kirim = $need;
      }

       

        


          if ($need<=0 OR $kirim<=0) {
              echo '';
          }

          
              
        
          else{
             echo '<tr><td class="text">'.$segment2.'</td><td class="text">'.$sku.'</td><td class="text">'.$barcode.'</td><td>'.$nama.'</td><td>'.$gudang.'</td><td>'.$toko.'</td><td>'.$max.'</td><td>'.$kirim.'</td><td>'.$uom.'</td><td></td></tr>';
          }
       
      


?>


  
  <?php $no++;} ?>


     </tbody>
</table>