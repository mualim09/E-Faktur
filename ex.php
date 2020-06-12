<?php
error_reporting(0);
 session_start();
if (empty($_SESSION['nm_user'])) {
    
     header("location:login.php");
// 
}

include_once 'koneksi.php';

include_once 'header.php';


      if(!empty($_GET['status']) && $_GET['status'] =='ok')
                {
                  echo '<script>sweetAlert("Berhasil..", "Data berhasil di simpan !", "success");</script>';
                  
                }
                


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
  $now = '2018-03-31';
  $sql2 ="select * from WHOpnameMs where initDate >= '$now'";
  $hasil2 = $conn2->query($sql2);

  $sql3 ="select * from dbo.SMSKUdt WHere segLevel='3'";
  $hasil3 = $conn2->query($sql3);
  $sql4 ="select WrhsCode,WrhsName from SMWrhs";
  $hasil4 = $conn2->query($sql4);
                
?>
<h1><center>Export Data Stock Opname</center></h1>
<div class="col col-sm-12">
<form>
  <table class="table table-striped">
      <tr>
        <td>
          SK Number
        </td>
        <td>
          <select name="sk" class="form-control" >
            <option>TEST</option>
        
          <?php

  while ($r2 = $hasil2->fetch()) {
   

          ?>
                    <option><?php echo $r2['OpnameNmbr']; ?></option>

                    <?php
$no++;
}

                    ?>
          </select>
        </td>
      </tr>
       <tr>
        <td>
          Lokasi SO
        </td>
        <td>
           <select class="form-control" name="wr">
                            <?php
$no=0;

  while ($r4 = $hasil4->fetch()) {
   

          ?>
                   <option value="<?php  echo $r4['WrhsCode'] ?>"><?php  echo $r4['WrhsCode']." - ".$r4['WrhsName'] ?></option>

                    <?php
$no++;
}

                    ?>
           </select>
        </td>
      </tr>
      
      <tr>
        <td></td>
        <td align="right">
            <button  type="submit" class="btn btn-primary col-lg-12"><i class="fa fa-search"></i> cari</button>
        </td>
      </tr>

      
  </table>
</form>
</div>

<table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
               <thead>
       <tr>
         <th data-priority="2">SK Number</th>
         <th data-priority="2">Warehouse</th>
         <th>Opname Number</th>
         <th data-priority="3">Tanggal</th>
         <th data-priority="1"><abbr title="Rotten Tomato Rating">Opname By</abbr></th>
  <th></th>
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;

$sk = $_GET['sk'];
$wr = $_GET['wr'];
  $sql = "select * from so where sk='$sk' and wr='$wr' group by ket";
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td><?php echo $data['sk']; ?></td>
    <td><?php echo $data['wr']; ?></td>
    <td><a href="list_so_lihat.php?id=<?php echo $data['ket'];?>&sk=<?php echo $data['sk'];?>" ><?php echo $data['ket']; ?></a></td>
    <td><?php echo $data['tgl']; ?></td>
    <td><?php echo $data['upd']; ?></td>
    <td><a onClick="return confirm('Apakah Anda yakin, akan Hapus ini ?');" href="ket_hapus.php?id=<?php echo $data['ket'];?>&sk=<?php echo $data['sk'];?>&wr=<?php echo $data['wr'];?>" ><i class="fa fa-trash"></i></a></td>
  
  

  </tr>
  <?php $no++;} ?>


     </tbody>
            </table>

</div>  
<div class="container">
  <div class="col col-sm-2 col-sm-offset-4">
      <form action="sk_excel.php">
                 <input type="hidden" name="sk" value="<?php echo $_GET['sk'] ?>">
                 <input type="hidden" name="wr" value="<?php echo $_GET['wr'] ?>">
                 <button class="btn btn-success" type="submit"><i class="fa fa-file-excel-o"></i> Export Biasa</button>
    </form>
  </div>
  <div class="col col-sm-2">
      <form action="sk_excel2.php">
                 <input type="hidden" name="sk" value="<?php echo $_GET['sk'] ?>">
                 <input type="hidden" name="wr" value="<?php echo $_GET['wr'] ?>">
                 <button class="btn btn-info" type="submit"><i class="fa fa-file-excel-o"></i> Export Pro-int</button>
              </form>
  </div>

  
</div>

<script type="text/javascript" language="javascript">
$(document).ready(function() {

    $('.tabza').DataTable();

  
    
} );


 </script>





<script type="text/javascript">

    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        //language:  'ind',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
       // language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>