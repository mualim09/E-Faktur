<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=out-proint.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

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


$sql ="select top 1 TransNmbr from dbo.WHTransHd WHERE TransNmbr like 'D59%' order by TransNmbr DESC";


$r = $conn->query($sql);
$kode = $r->fetch();
 $kode = $kode['TransNmbr'];

$filter = explode("-", $kode);


   $kode_old = $filter[2]+0;

  $next = $filter[2]+1;

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

      

  $new = $filter[0]."-".$filter[1]."-".$nom.$next;




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
                        <th>Transaction No</th>
                        <th>Transaction date</th>
                        <th>Warehouse Code</th>
                        <th>Product Code</th>
                        <th>Qty</th>
                        <th>UOM</th>
                        <th>Batch No</th>
                        <th>Expire Date</th>
                        <th>QC Number</th>
                    </tr>
                </thead>
                <tbody>
                    
                      <?php 
                          $q = $_GET['query'];

                           $no=1;

                         $hasil = $conn->query($q);


                          while ($row = $hasil->fetch()) {

                      ?>
                      <tr>
                      <td><?php echo $new;?></td>
                        <td><?php echo date('d/m/Y')?></td>
                        <td class="text"><?php echo "004"?></td>
                        <td class="text"><?php echo $sku =  $row['TransProduct'] ?></td>
                        <td><?php echo $row['TransOutQty'] ?></td>
                        <td><?php echo $row['TransUOM'] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
  
                        
                        </tr>
                    <?php $no++; } ?>
                    
                </tbody>
            </table>