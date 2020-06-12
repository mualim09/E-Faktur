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

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-4">
    <a href="list_so.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali </a>
    <a href="list_so_lihat_print.php?id=<?php echo $id; ?>&sk=<?php echo $sk; ?>" class="btn btn-success"><i class="fa fa-print"></i> Print TOKO</a>
    <a href="list_so_lihat_print_gd.php?id=<?php echo $id; ?>&sk=<?php echo $sk; ?>" class="btn btn-warning"><i class="fa fa-print"></i> Print GUDANG</a>
  </div>
  <div class="col col-sm-6">
    <h2>DETAIL LIST STOCK OPNAME</h2>
  </div>
  <div class="col col-sm-3">
    <?php echo "<center><h2>".$id."</h2></center>"; ?>
  </div>
                   
<hr>
   <table class="display tabza table table-striped table-hover table-bordered text-justify" width="100%" cellspacing="0">
                <thead>
                <tr class="bg bg-primary" style="background-color:  ">
                 <th data-priority="2">SK Number</th>
                 <th>Opname Number</th>
                 <th>Tanggal</th>
                 <th>SKU</th>
                 <th>Nama</th>
                 <th>Qty</th>
                 <th>UOM</th>
                 <th>opname By</abbr></th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
                 $no=1;
                  $sql =$conn->query("select * from so where ket='$id' and sk='$sk'");
                  
                  while($r = $sql->fetch()){
              ?>
              <tr>
                <td><?php echo $r['sk']; ?></td>
          <td><a href="list_so_lihat.php?id=<?php echo $r['ket']; ?>" data-rel="external"><?php echo $r['ket']; ?></a></td>
          <td><?php echo $r['tgl']; ?></td>
        <td><?php echo $sku = $r['sku']; ?></td>
        <td><?php 

            $sql2 = "select * from SMproductMs Where Prodcode='$sku'";
            $r2 = $conn2->query($sql2)->fetch();

            echo $r2['ProdName'];



        ?></td>
        <td><?php echo $r['qty']; ?></td>
        <td><?php echo $r['uom']; ?></td>
          <td><?php echo $r['upd']; ?></td>

                <td class="ctr">
                  <div class="btn-group">


                    <a onClick="return confirm('Apakah Anda yakin, akan Hapus ini ?');" href="../so/hapus_scan_dt2.php?sk=<?php echo $r['sk']; ?>&sku=<?php echo $r['sku']; ?>&ket=<?php echo $r['ket']; ?>&tgl=<?php echo $r['tgl']; ?>&upd=<?php echo $r['upd']; ?>" >
                    <i class="fa fa-trash"> </i></a>&nbsp;



                  </div>
                </td>
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

    $('.tabza').DataTable();

  
    
} );


 </script>
