<?php 
set_time_limit(0);
$sk = $_GET['sk'];
$wr = $_GET['wr'];
$kjam = date('H');
$ktgl = date('ymd');
 $kode = $ktgl."_(ALL-AREA)_".str_replace(" ", "", $sk);

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PROINT-".$kode.".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

$host="localhost";
$db="so";
$user="root";
$pass="";

$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);

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
                        <th>SK Number</th>
                        <th>Warehouese Id</th>
                        <th>Warehouese Line</th>
                        <th>Warehouese Sub Line</th>
                        <th>Product Id</th>
                        <th>Qty</th>
                        <th>Standard UOM</th>
                        <th>Batch No</th>
                        <th>Expire Date</th>
                        <th>QC Number</th>
                        <th>Bar Code</th>
                        <th>Condition Id</th>
                        <th>Description</th>
                        <th>Opname By</th>
                        
                        
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
                              `so` WHERE sk='$sk' and wr='$wr'
                          GROUP BY `sku`;";

                           

                         $hasil = $conn->query($q);


                          while ($row = $hasil->fetch()) {

                      ?>
                      <tr>
                      <td><?php echo $row['sk'] ?></td>
                        <td class="text"><?php echo $row['wr'] ?></td>
                        <td></td>
                        <td></td>
                        <td class="text"><?php echo $sku =  $row['sku'] ?></td>
                        <td><?php echo number_format($row['qty'],3) ?></td>
                        <td><?php echo $row['uom'] ?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $row['upd'] ?></td>
                        <td></td>
                        <td></td>
                        <td class="text"><?php 
                        $a="";
                       
                          $hasil2 = $conn->query("select * from so where sku='$sku' and sk='$sk' and wr='$wr'");
                          while ($row2 = $hasil2->fetch()) {
                                $ket = $row2['ket']."/";
                               $a .=$ket;
                          }
                          
                           $a;
                            $panjang = strlen($a);
                            $b = $panjang-1;

                           echo substr($a,0,$b);

                          
                        ?></td>
                        <td class="text">00000</td>
                        
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>