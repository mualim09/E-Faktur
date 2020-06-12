<?php
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

    
  $no=1;
  $now = '2017-09-30';//date('Y-m-d');
  $sql2 ="select * from WHOpnameMs where InitDate >= '$now'";
  $hasil2 = $conn2->query($sql2);
                
                
                
                
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
    
  </div>
  <div class="col col-sm-7">
    <h2>IMPORT GRN to TI-TO</h2>

  </div>
    <form>
      <table class="table table-striped">
          <tr>
            <td>Masukan GRN</td>
            <td>
              <textarea class="form-control" name="cari"></textarea>
              <button class="btn btn-danger" type="Submit">Cari</button>
              
      </form>  
            </td>
            <td>
            <?php
            if (!empty($_GET['cari'])) {
  $cari = str_replace(",", "','", $_GET['cari']);



  $sql="select grnproduct,Convert(float,sum(grnstdqty)) as grnstdqty,grnstduom from dbo.PRGRNdT WHERE GrnNmbr in ('$cari') Group By grnproduct,grnstduom";
}
else{
  $sql="select grnproduct,qrnstdqty,grnstdqty from dbo.PRGRNdT WHERE GrnNmbr=''";
}

            ?>


            <td>
              <form action="sk_excel3.php">
                 <textarea style="display: none;" name="query"><?php echo $sql ?></textarea>
                 <button class="btn btn-info" type="submit"><i class="fa fa-file-excel-o"></i> Export Pro-int</button>
              </form>
            </td>
          </tr>
      </table>
            
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
               <thead>
       <tr>
         <th>SKU</th>
         <th>Nama</th>
         <th>Qty</th>
         <th>Uom</th>
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;


  
  $hasil = $conn2->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td><?php echo $sku = $data['grnproduct']; ?></td>
    <td><?php  $r = $conn2->query("select ProdName from SmProductMs Where ProdCode='$sku'");
 $r = $r->fetch();
      echo $r['ProdName']

    ?></td>
    <td><?php echo $data['grnstdqty']; ?></td>
    <td><?php echo $data['grnstduom']; ?></td>
	
  

  </tr>
  <?php $no++;} ?>


     </tbody>
            </table>

</div>  
