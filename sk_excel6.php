<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=plannogram.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

error_reporting(1);
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

    
  // $no=1;
  // $now = '2017-09-30';//date('Y-m-d');
  $sql2 ="select segCode ,segDesc, segLevel from dbo.SMSKUdt where segLevel='7'";
  $hasil2 = $conn2->query($sql2);
                
                
                
                
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
        <th>Lokasi</th>
         <th data-priority="2">SKU</th>
         <th>Nama</th>
         <th>Uom</th>
         <th>AVG</th>
         <th>Selv</th>
         <th>Bar</th>
         <th>Tier</th>
         <th>Vol</th>
         <th>Height</th>
         <th>MAX</th>
         <th>MIN</th>
         <th>KIRIM PER_DAY</th>
         <th>GD</th>
         <th>TOKO</th>
         <th>Ket</th>
<!--          <th data-priority="3">Avrerage</th>
         <th data-priority="1"><abbr title="Rotten Tomato Rating">Max</abbr></th> -->
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;

  $sql="select * from lokasi";
  
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td>
      <?php echo $data['lok']; ?>
    </td>
    <td class="text"><?php echo $sku =  $data['sku']; ?></td>
    <?php
        $sqlbarang = "select top 1 * from SmProductMs where prodcode='$sku'";
        $barang = $conn2->query($sqlbarang)->fetch();
         $barang['ProdName'];
    ?>
    <td><?php echo $barang['ProdName']; ?></td>
    <td><?php echo $barang['ProdUOM']; ?></td>
    
    <td><?php 
                 $r1 = $conn->query("select * from afi where id='$sku' limit 1")->fetch();


                 echo !empty($r1['avg'])?$r1['avg']:'<a href="plan_add.php?id='.$sku.'" class="btn btn-primary"><i class="fa fa-plus"></i></a>';
                  $avg=$r1['avg'];

    ?></td>
    <td><?php echo $data['sel']; ?></td>
     <td><?php echo $data['bar']; ?></td>
      <td><?php echo $data['tir']; ?></td>
       <td><?php echo $data['vol']; ?></td>
        <td><?php echo $data['tin']; ?></td>
     <td><?php 


                 echo !empty($r1['max'])?$r1['max']:'';
                  $max=$r1['max'];

    ?></td>
      <td>
      <?php

            $op =5;$lt=2;
             $konstanta = $max/(($op+$lt)*2);
             $min = ($op+(2*$lt))*$konstanta;
             echo ceil($min);


      ?>
    </td>
	
  <td><?php echo $jml = number_format($avg/$max,3); ?></td>

<td>
   <?php
        $sqlbarang = "select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='002'";
        $barang = $conn2->query($sqlbarang)->fetch();
         echo $gudang = $barang['ProdQty'];
    ?>
</td>
<td>
  <?php
        $sqlbarang = "select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='001'";
             $barang = $conn2->query($sqlbarang)->fetch();
         echo $toko = $barang['ProdQty'];
        
    ?>
</td>
<td>
  <?php
   if ($toko >= $max) {
           echo " (cek)";
         }
         elseif (empty($toko) && empty($toko)) {
           echo " (kosong)";
         }
  ?>
</td>
  </tr>
  
  <?php $no++;} ?>


     </tbody>
            </table>

</div>  


<script type="text/javascript">
   $('.select-eza').selectize({
    create: true,
    sortField: 'text',
    // onOptionAdd: function (value, $item) { 
    //       var link='... link ...' + value;
    //       load_modal_content (link, '... csrf ...');
    //       $('#modal').modal('show');
    //       $item.selectize.removeOption(value);
    //   },
});

   $('.tabza').DataTable({

      "scrollY":        "350px",
        "scrollCollapse": true,
        "searching": false,
        "paging":         false
   });


</script>