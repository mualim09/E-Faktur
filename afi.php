<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

error_reporting(1);
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

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
<!--     <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a> -->
  </div>
  <div class="col col-sm-7">
    <h2>AUTO FILL IN</h2>

  </div>
    <form>
      <table class="table table-striped">
          <tr>
            <td>Category Barang</td>
            <td>
              <select name="cari" class="select-eza form-control" ><?php

                while ($r2 = $hasil2->fetch()) {
                 

                        ?>
                                  <option value="<?php echo $r2['segCode']?>"><?php echo $r2['segCode']." - ".$r2['segDesc']; ?></option>

                                  <?php
              $no++;
              }

                    ?>




               
              </select>
               </form>  
            </td>
            <td>
              <button type="submit" class="btn btn-danger">Cari</button>
            </td>
            <td>
            <?php
            if (!empty($_GET['cari'])) {
  $cari = $_GET['cari'];
 //$sql="select * from afi WHERE sk='$cari' group by ket";
}
else{
  $sql="select * from afi";
}

            ?>
             <!--  <form action="sk_excel.php">
                 <textarea style="display: none;" name="query"><?php echo $sql ?></textarea>
                 <button class="btn btn-success" type="submit"><i class="fa fa-file-excel-o"></i> Export</button>
              </form> -->
            </td>
            <td>
              <!-- <form action="sk_excel2.php">
                 <textarea style="display: none;" name="query"><?php echo $cari ?></textarea>
                 <button class="btn btn-info" type="submit"><i class="fa fa-file-excel-o"></i> Export Pro-int</button>
              </form> -->
            </td>
          </tr>
      </table>
            
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
      <thead>
       <tr>
         <th data-priority="2">SKU</th>
         <th>Nama</th>
         <th>Uom</th>
         <th>Segment</th>
         <th>AVG</th>
         <th>MAX</th>
         <th>MIN</th>
         <th>SOH GUDANG</th>
         <th>SOH TOKO</th>
         <th>Needs</th>
         <th>Kirim</th>
<!--          <th data-priority="3">Avrerage</th>
         <th data-priority="1"><abbr title="Rotten Tomato Rating">Max</abbr></th> -->
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;

  $sql="select top 500 SMProdField.prodcode,prodname,prodUom,SMProdField.SegParent,SMProdField.SegCode,segLevel,SegDesc 
from (SMProdField inner join smproductms on smproductms.prodcode = SMProdField.prodcode)
inner join SMSKUdt on SMSKUdt.segcode = SMProdField.segcode where SMSKUdt.segcode='$cari'";
  
  $hasil = $conn2->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td><?php echo $sku =  $data['prodcode']; ?></td>
    <td>
      <?php echo $data['prodname']; ?>
    </td>
    <td><?php echo $data['prodUom']; ?></td>
    <td>
      <?php echo $data['SegCode']." - ".$data['SegDesc']; ?>
    </td>
    <td><?php 
                 $r1 = $conn->query("select * from afi where id='$sku' limit 1")->fetch();
                 echo !empty($r1['avg'])?$r1['avg']:'';
                 $avg=$r1['avg'];

    ?></td>
     <td><?php 


                 echo !empty($r1['max'])?$r1['max']:'';
                  $max=$r1['max'];

    ?></td>
    <td>
      <?php

            $op =5;$lt=2;
             $konstanta = $max/(($op+$lt)*2);

             $min = ($op+(2*$lt))*$konstanta;
             echo $min= ceil($min);


      ?>
    </td>
    <td><?php 
                 $r1 = $conn2->query("select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='002'")->fetch();


                 echo $gudang = 100;//$r1['ProdQty'];

    ?></td>
    <td><?php 
                 $r1 = $conn2->query("select top 1 Convert(float,ProdQty) ProdQty from dbo.WHCurrentStock where prodcode = '$sku' and wrhsCode='001'")->fetch();


                 echo $toko = 21  ;//$r1['ProdQty'];

    ?></td>
    <td><?php 
                 if ($toko <= $min) {
                    echo $need = $max-$toko;      
                 }
                 else{
                  echo $need =0;
                 }


    ?></td>
    <td><?php 
                 if ($gudang <= $need) {
                    echo $need = $gudang;      
                 }
                 else{
                  echo $need;
                 }


    ?></td>
	
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