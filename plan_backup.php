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
    <h2>PLANNOGRAM</h2>

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
              <button type="submit" class="btn btn-info">Cari</button>
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
         <th></th>
         <th>KIRIM PER_DAY</th>
         <th>Nilai 1</th>
         <th>Nilai 2</th>
         <th>Keputusan</th>
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
    <td><?php echo $sku =  $data['sku']; ?></td>
    <?php
        $sqlbarang = "select top 1 * from SmProductMs where prodcode='$sku'";
        $barang = $conn2->query($sqlbarang)->fetch();
         $barang['ProdName'];
    ?>
    <td><?php echo $barang['ProdName']; ?></td>
    <td><?php echo $barang['ProdUOM']; ?></td>
    <td>
      <?php //echo $data['SegCode']." - ".$data['SegDesc']; ?>
    </td>
    <td><?php 
                 $r1 = $conn->query("select * from afi where id='$sku' limit 1")->fetch();


                 echo !empty($r1['avg'])?$r1['avg']:'<a href="plan_add.php?id='.$sku.'" class="btn btn-primary"><i class="fa fa-plus"></i></a>';
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
             echo ceil($min);


      ?>
    </td>
  
  <td>
    <?php
     echo !empty($r1['avg'])?'<a  href="plan_edit.php?id='.$sku.'&avg='.$avg.'&max='.$max.'" class="btn btn-success"><i class="fa fa-pencil"></i></a>':'';

     ?>
  </td>
  <td><?php echo $jml = $avg/$max; ?></td>
  <td><?php 
              if ($jml <= 3) {
                echo $n1 = "MAX OK";
              }
              else{
                echo $n1 = '<div class="alert alert-success" role="alert">
                            <a class="alert-link">UP</a>
                          </div>';
              }
  ?></td>
  <td><?php 
          
              if ($jml >= 0.1) {
                echo $n2 = "MAX OK";
              }
              else{
                echo $n2 = '<div class="alert alert-danger" role="alert">
                            <a class="alert-link">DOWN</a>
                          </div>';
              }
  ?></td>
  <td><?php 
        if ($n1="MAX OK" AND $n2="MAX OK") {
                echo  "OK";
              }
              else{
                echo '<div class="alert alert-warning" role="alert">
                            <a class="alert-link">ANOMALI</a>
                          </div>';
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