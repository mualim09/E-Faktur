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

    
  $no=1;
  $now = '2018-02-25';//date('Y-m-d');
  $sql2 ="select * from WHOpnameMs where InitDate >= '$now'";
  $hasil2 = $conn2->query($sql2);
                
                
                
                
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
    <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a>
  </div>
  <div class="col col-sm-7">
    <h2>LIST STOCK OPNAME</h2>

  </div>
    <form>
      <table class="table table-striped">
          <tr>
            <td>SK Number</td>
            <td>
              <select name="cari" class="form-control" onchange="this.form.submit()">
                <option>...</option>
                <option>TEST</option>
          <?php

                while ($r2 = $hasil2->fetch()) {
                 

                        ?>
                                  <option <?php echo !empty($_GET['cari']==$r2['OpnameNmbr'])?'selected':''; ?>><?php echo $r2['OpnameNmbr']; ?></option>

                                  <?php
              $no++;
              }

                    ?>



               
              </select>
               </form>  
            </td>
            <td>
            <?php
            if (!empty($_GET['cari'])) {
  $cari = $_GET['cari'];
 $sql="select * from so WHERE sk='$cari' group by ket";
}
else{
  $sql="select * from so WHERE sk=''";
}

            ?>
             
            </td>
            <td>
              
            </td>
          </tr>
      </table>
            
<hr>
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