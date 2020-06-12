<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=plannogram.xls");//ganti nama sesuai keperluan
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


$sql="select * from lokasi";
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
         <th data-priority="1">Lokasi</th>
         <th>Ket</th>
         <th>Sku</th>
         <th>Nama</th>
         <th>Uom</th>
         <th>Selv</th>
         <th>Bar</th>
         <th>Tier</th>
         <th>Vol</th>
         <th>Height</th>
         <th>MAX</th>
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;

  
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {

   if (strlen($data['bar'])==1) {
     $nol=0;
   }
   else{

    $nol='';
   }
   ?> 
  <tr>  
    <td><?php echo $data['lok']; ?></td>
    <td><?php echo $data['lok']."-S".$data['sel']."-$nol".$data['bar']."-T".$data['tir']; ?></td>
    <td class="text"><?php echo $sku =  $data['sku']; ?></td>
    <?php
        $sqlbarang = "select top 1 * from SmProductMs where prodcode='$sku'";
        $barang = $conn2->query($sqlbarang)->fetch();
         $barang['ProdName'];
    ?>
    <td><?php echo $barang['ProdName']; ?></td>
    <td><?php echo $barang['ProdUOM']; ?></td>
    <td><?php echo $data['sel']; ?></td>
    <td><?php echo $data['bar']; ?></td>
    <td><?php echo $data['tir']; ?></td>
    <td><?php echo $data['vol']; ?></td>
    <td><?php echo $data['tin']; ?></td>
    <td><?php echo $data['max']; ?></td>

  </tr>
  <?php $no++;} ?>


     </tbody>
            </table>