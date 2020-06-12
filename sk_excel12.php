<?php 
// untuk FOOD 1 Import
set_time_limit(0);
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
$kjam = date('H');
$ktgl = date('ymd');

$kodeE = "FD1".$ktgl."-".$kjam;

//excel untuk ti to ke toko
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=import-proint-".$kodeE.".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
date_default_timezone_set("Asia/Jakarta");



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


// buat kode cuy

$sql ="select top 1 * from dbo.WHTransHd WHERE TransNmbr like 'B54%' order by TransNmbr DESC";
$r = $conn2->query($sql);
$kode = $r->fetch();
$kode = $kode['TransNmbr'];

$filter = explode("-", $kode);
$bulan_old = $filter[1];
     $tahun = date('y');
     $bulan = date('m');

if ($bulan=='01') {
        
         $tahun = $tahun."A";
}
elseif ($bulan=='02') {
        
         $tahun = $tahun."B";
}
elseif ($bulan=='03') {
         $tahun = $tahun."C";
}
elseif ($bulan=='04') {
        
         $tahun = $tahun."D";
}
elseif ($bulan=='05') {
        
         $tahun = $tahun."E";
}
elseif ($bulan=='06') {
        
         $tahun = $tahun."F";
}
elseif ($bulan=='07') {
        
         $tahun = $tahun."G";
}
elseif ($bulan=='08') {
        
         $tahun = $tahun."H";
}
elseif ($bulan=='09') {
        
         $tahun = $tahun."I";
}
elseif ($bulan=='10') {
        
         $tahun = $tahun."J";
}
elseif ($bulan=='11') {
        
         $tahun = $tahun."K";
}
elseif ($bulan=='12') {
        
         $tahun = $tahun."L";
}

// filter code

 $kode_old = $filter[2]+0;


// cek apakah beda bulan ?

if ($tahun != $bulan_old ) {
  $next = 0+1;
}
else{
 $next = $filter[2]+1;
}



  $hitung = strlen($next);
        
        if($hitung==0)
        { $nom='00000'; }
        elseif($hitung==1)
        { $nom='0000'; }
        elseif($hitung==2)
        { $nom='000'; }
        elseif($hitung==3)
        { $nom='00'; }
      elseif($hitung==4)
        { $nom='0'; }
      elseif($hitung==5)
        { $nom=''; }

      

$new = $filter[0]."-".$tahun."-".$nom.$next;
$jam = date('H:i:s');





?>
<style type="text/css">
  
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
  <table style="border-collapse: collapse;" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No_TO</th>
                        <th>Transaction_Date</th>
                        <th>Warehouse_Target</th>
                        <th>Seq</th>
                        <th>Product_Code</th>
                        <th>Qty</th>
                        <th>UOM</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>


     <?php 
     

   $no=1;

  $sql="SELECT sku,SUM(`max`) as max FROM lokasi GROUP BY sku ORDER BY sku";
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

          elseif($segment == "11.05.01" OR $segment == "11.05.02" OR $segment == "11.05.03" OR $segment == "11.05.04" OR $segment == "11.05.05"){
               echo '<tr><td class="text">'.$new.'</td><td class="text">'.date('d/m/Y').'</td><td class="text">001</td><td class="text">'.$no.'</td><td class="text">'.$sku.'</td><td class="text">'.$kirim.'</td><td class="text">'.$uom.'</td><td class="text">FOOD 3 AFI '.$kodeE.'TRANSFER JAM : '.$jam.'</td></tr>';
               $no++;
          }
          else{
            echo '';
          }
       

      


                     

            } ?>
                    
                </tbody>
            </table>