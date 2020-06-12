<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

include_once 'koneksi.php';
include_once 'header.php';


    

$id = $_GET['id'];
$sk= $_GET['sk'];

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
<body onload="window.print()">
<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-2">
  </div>
  <div class="col col-sm-3">
    <h4>LIST STOCK OPNAME GUDANG</h4>
  </div>
   <div class="col col-sm-2">
    <h4><?php echo date('ymd'); ?></h4>
  </div>
   <div class="col col-sm-2">
    <h4><?php echo $sk; ?></h4>
  </div>
  <div class="col col-sm-2">
    <?php echo "<center><h4>".$id."</h4></center>"; ?>
  </div>
                   
<hr>
   <table class="table tabza2 table-striped table-hover table-bordered text-justify" width="100%" cellspacing="0" style="font-size: 9px">
                <thead>
                <tr class="bg bg-primary" style="background-color:  ">
                <th>No</th>
                 <th width="10%">Lokasi</th>
                 <th>Barcode</th>
                 <th>SKU</th>
                 <th>Nama</th>
                 <th width="3%">Qty so</th>
                 <th width="3%">Current</th>
                 <th width="3%">Selisih</th>
                 <th>UOM</th>
                 <th>User</abbr></th>
<th></th>
                </tr>
              </thead>
              <tbody>
              <?php
              
                 $no=1;
                  $sql =$conn->query("select * from so where ket='$id' and sk='$sk'");
                  
                  while($r = $sql->fetch()){

                      $sku = $r['sku'];
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



              ?>
              <tr>
                 <td><?php echo $no;?></td>
          <td><?php echo $r['ket']."/".$jml; ?></td>
           <td><?php echo $barcode; ?></td>
        <td><?php echo $sku; ?></td>
        <td><?php 

            $sql2 = "select * from SMproductMs Where Prodcode='$sku'";
            $r2 = $conn2->query($sql2)->fetch();

            echo $r2['ProdName'];



        ?></td>
        <td><?php echo $r['qty']; ?></td>
         <td><?php echo $gudang ?></td>
          <td><?php echo  $sls = $r['qty']-$gudang?></td>
        <td><?php echo $r['uom']; ?></td>
          <td><?php echo $r['upd']; ?></td>
        <td><?php 
			if($sls == 0){echo 'V';}
 ?></td>

              
              </tr>
              <?php 


              $no++; 

            }
              ?>
              
              </tbody>
            </table>

</div>  

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
        "order": [[ 4, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

  
    
} );


 </script>
