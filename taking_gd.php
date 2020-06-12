<?php 
set_time_limit(0);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=taking_gudang.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

include_once 'koneksi.php';

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



$host="localhost";
$db="so";
$user="root";
$pass="";

$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
 $sk = $_GET['query'];
                         $tgl = $_GET['tgl'];
?>
<style type="text/css">
  
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
<center><h3>STOK TAKING GUDANG / <?php echo $tgl." / ".$sk?></h3></center>
  <table style="border-collapse: collapse;" cellspacing="0" width="100%" class="table tabza2">
                <thead>
                    <tr>
                      <th>No</th>
                        <th>Product Id</th>
                        <th>Barcode</th>
                        <th>Nama</th>
                        <th>Current</th>
                        <th>Qty SO</th>
                        <th>Selisih</th>
                        <th>UOM</th>
                        <th>Description</th>     
                        
                    </tr>
                </thead>
                <tbody>
                    
                      <?php 

                         $q = "SELECT
                              `sk`
                              , `wr`
                              , `sku`
                              , SUM(`qty`) as qty
                              , `uom`
                              , `ket`
                              , `upd`
                              , `tgl`
                          FROM
                              `so` WHERE sk='$sk' and tgl='$tgl'
                          GROUP BY `sku`";

                           

                         $hasil = $conn->query($q);


                          while ($row = $hasil->fetch()) {

                            $sku = $row['sku'];
// untuk cek lokasi lebih dari 1 
                      $sqlBarangL = "SELECT COUNT(*) AS jml FROM so WHERE sku='$sku' AND sk='$sk'";
                      $sqlBarangL = $conn->query($sqlBarangL)->fetch();
                    $jml = $sqlBarangL['jml'];

                    //untuk barcode barang
        $sqlbarangB = "select top 1 ProdBarcode from dbo.SMProdBarcode where fgBarcodeDefault='Y' and prodcode= '$sku'";
        $barangB = $conn2->query($sqlbarangB)->fetch();
          $barcode = $barangB['ProdBarcode'];
//untuk gudang
             $sqlbarangG = "select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='002'";
        $barangG = $conn2->query($sqlbarangG)->fetch();
        $gudang = $barangG['ProdQty'];

//untuk toko

      $sqlbarangT = "select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='001'";
             $barangT = $conn2->query($sqlbarangT)->fetch();
          $toko = $barangT['ProdQty'];
// nama barang 
          $sql2 = "select * from SMproductMs Where Prodcode='$sku'";
            $r2 = $conn2->query($sql2)->fetch();

             $nama = $r2['ProdName'];

                      ?>
                      <tr>
                        <td></td>
                        <td class="text"><?php echo $sku =  $row['sku'] ?></td>
                         <td class="text"><?php echo $barcode ?></td>
                          <td class="text"><?php echo $nama ?></td>
                        <td><?php echo $curr = number_format($gudang,3) ?></td>
                        <td><?php echo $qty = number_format($row['qty'],3) ?></td>
                        <td><?php echo number_format($qty-$curr,3) ?></td>
                        <td><?php echo $row['uom'] ?></td>
                        <td class="text"><?php 
                        $a="";
                       
                          $hasil2 = $conn->query("select * from so where sku='$sku' and sk='$sk'");
                          while ($row2 = $hasil2->fetch()) {
                                $ket = $row2['ket']."/";
                               $a .=$ket;
                          }
                          
                           $a;
                            $panjang = strlen($a);
                            $b = $panjang-1;

                           echo substr($a,0,$b);

                          
                        ?></td>
                        
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>

            <script type="text/javascript" language="javascript">
$(document).ready(function() {

       var t = $('.tabza2').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
      
            "targets": 0
        } ],
  "paging":false,
  "searching":false,
        "order": [[ 3, 'asc' ]],
  "columnDefs": [
    { "width": "5%", "targets": 0 }
  ]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

  
    
} );



 </script>