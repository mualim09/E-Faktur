<?php
set_time_limit(0);
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

error_reporting(0);
include_once 'koneksi.php';
include_once 'header.php';


    
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

    
  // $no=1;
  // $now = '2017-09-30';//date('Y-m-d');
  $sql2 ="select segCode ,segDesc, segLevel from dbo.SMSKUdt where segLevel='7'";
  $hasil2 = $conn2->query($sql2);
                
                
                
                
?>
<a href="sk_excel6.php" class="btn btn-success">Export To Excel</a>
<a href="sk_excel7.php" class="btn btn-danger">Print Untuk Afi</a>
<a href="sk_excel8.php" class="btn btn-primary">Excel to Proint</a>
<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
<!--     <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a> -->
  </div>
  <div class="col col-sm-7">
    <h2>PLANNOGRAM</h2>
<?php
function Needs($n,$k)
      {
          if ($n<=0 OR $k<=0) {
              
              echo "none";

          }
      }



?>
  </div>
    
            
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
      <thead>
       <tr>
        <th>Segment</th>
        <th>SKU</th>
        <th>Barcode</th>
         <th>Nama</th>    
         <th>AVG</th>
         <th>MAX</th>
         <th>MIN</th>
         <th>KIRIM PER_DAY</th>
         <th>GD</th>
         <th>TOKO</th>
         <th>Need</th>
         <th>Keli</th>
         <th>Kirim</th>
         <th>UOM</th>
        
         
<!--          <th data-priority="3">Avrerage</th>
         <th data-priority="1"><abbr title="Rotten Tomato Rating">Max</abbr></th> -->
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
         $segment2 = $barangS['SegDesc'];

//untuk min
             $op =5;$lt=2;
             $konstanta = $max/(($op+$lt)*2);
             $min = ($op+(2*$lt))*$konstanta;
              $min = ceil($min);

//untuk kirim per-day
              $sqlAV="SELECT avg,kel FROM afi WHERE id='$sku'";
              $hasilAV = $conn->query($sqlAV)->fetch();
              $avg = $hasilAV['avg'];
              $kel = $hasilAV['kel'];
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

          elseif($segment == "11.05.09" OR $segment == "11.05.10" OR $segment == "11.05.11" OR $segment == "11.05.12" OR $segment == "11.05.13" OR $segment == "11.05.14" OR $segment == "11.05.15" OR $segment == "11.05.16" OR $segment == "11.05.17" OR $segment == "11.05.18" OR $segment == "11.05.19"){
               echo '<tr><td class="text">'.$segment2.'</td><td class="text">'.$sku.'</td><td class="text">'.$barcode.'</td><td>'.$nama.'</td><td>'.$avg.'</td><td>'.$max.'</td><td>'.$min.'</td><td>'.$jml.'</td><td>'.$gudang.'</td><td>'.$toko.'</td><td>'.$need.'</td><td>'.$kel.'</td><td class="bg-success">'.$kirim.'</td><td>'.$uom.'</td></tr>';
          }
          else{
            echo "";
          }
       
      


?>


  
  <?php $no++;} ?>


     </tbody>
</table>

</div>  




<script type="text/javascript">


   $('.tabza').DataTable({

      "scrollY":        "350px",
        "scrollCollapse": true,
        "searching": false,
        "paging":         false
   });


</script>