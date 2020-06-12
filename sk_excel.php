<?php 
$sk=$_GET['sk'];
$wr=$_GET['wr'];
$kjam = date('H');
$ktgl = date('ymd');

 $kode = $ktgl."_(PER-AREA)_".str_replace(" ", "", $sk);


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=SO-".$kode.".xls");//ganti nama sesuai keperluan
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
                      $sql = "select * from so where sk='$sk' and wr='$wr'";
                         $hasil = $conn->query($sql);
                          while ($row = $hasil->fetch()) {

                      ?>
                      <tr>
                      <td><?php echo $row['sk'] ?></td>
                        <td class="text"><?php echo $row['wr'] ?></td>
                        <td></td>
                        <td></td>
                        <td class="text"><?php echo $row['sku'] ?></td>
                        <td><?php echo number_format($row['qty'],3) ?></td>
                        <td><?php echo $row['uom'] ?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $row['upd'] ?></td>
                        <td></td>
                        <td></td>
                        <td class="text"><?php echo $row['ket'] ?></td>
                        <td class="text">00000</td>
                        
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>