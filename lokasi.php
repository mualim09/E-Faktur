<?php
// session_start();
// if (empty($_SESSION['nm_user'])) {
    
//     header("location:login.php");
// }

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
  $sql2 ="select DISTINCT lok from lokasi";
  $hasil2 = $conn->query($sql2);
                
                
                
                
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
<!--     <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a> -->
<!-- <a href="setpajangan.php" class="btn btn-primary"><i class="fa fa-refresh"></i> Calculate Pajangan</a> -->

<a href="foto.php" class="btn btn-danger"><i class="fa fa-camera"></i> Foto Lokasi</a>
  </div>
  <div class="col col-sm-7">
    <h2>PLANNOGRAM</h2>
    
  </div>
    
      <table class="table table-striped">
          <tr>
            <td>Lokasi</td>
            <td>
              <form>
              <select name="cari" class="select-eza form-control" ><?php

                while ($r2 = $hasil2->fetch()) {
                 

                        ?>
                                  <option <?php echo $_GET['cari']==$r2['lok']?'selected':''; ?>><?php echo $r2['lok']; ?></option>

                                  <?php
              $no++;
              }

                    ?>




               
              </select>
              <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
               </form>  
            </td>
            <td>
              
            </td>
             <td>By SKU</td>
            <td>
              <form>
              <input class="form-control" type="" name="cari2" placeholder="masukan sku">
              <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
               </form>  
            </td>
            <td>
              
            </td>
            <td>
            <?php
            if (!empty($_GET['cari'])) {
  $cari = $_GET['cari'];
 $sql="select * from lokasi WHERE lok='$cari'";
}
elseif(!empty($_GET['cari2'])){
$cari2 = $_GET['cari2'];
 $sql="select * from lokasi WHERE sku like '%$cari2%'";
}
else{
  $sql="select * from lokasi limit 0";
}

            ?>
      
            </td>
            <td>
              <form action="sk_excel5.php">

                 <textarea style="display: none;" name="query"><?php echo $sql ?></textarea>
                 <button class="btn btn-success" type="submit"><i class="fa fa-file-excel-o"></i> Export Excel</button>
              </form>
            </td>
          </tr>
      </table>
             
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
      <thead>
       <tr>
         <th data-priority="1">Lokasi</th>
         <th>Ket</th>
         <th class="text">Sku</th>
         <th>Nama</th>
         <th>Uom</th>
         <th>Selv</th>
         <th>Bar</th>
         <th>Tier</th>
         <th>Vol</th>
         <th>Height</th>
         <th>MAX</th>
         <th></th>
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
    <td><?php echo $sku =  $data['sku']; ?></td>
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
    <td>
      <div class="btn-group btn-group-sm" role="group" aria-label="...">
        <a class="btn btn-sm btn-primary" href="../sc/edit_plan.php?sku=<?php echo $data['sku']; ?>&lok=<?php echo $data['lok']; ?>&id=<?php echo $data['id']; ?>"><i class="fa fa-pencil"> </i></a>
      </div>
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
        "searching": true,
        "paging":         false
   });
</script>