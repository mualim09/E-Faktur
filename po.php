<?php
error_reporting(0);
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

$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
  $sql2 ="select DISTINCT PRPOHd.POsuplier, SupName
from PRPOHd inner join SmSupplierMS on PRPOHd.POsuplier = SmSupplierMS.supId 
WHERE PRPOHd.PODate between '2017-01-01' and '2017-12-31' order by PRPOHd.POsuplier ASC";
  $hasil2 = $conn2->query($sql2);
                
$idsup = $_GET['cari'];


 $sql3 = "select DISTINCT POSalesId
from PRPOHd inner join SmSupplierMS on PRPOHd.POsuplier = SmSupplierMS.supId 
WHERE PRPOHd.PODate between '2017-01-01' and '2018-12-31' and PRPOHd.POsuplier in('$idsup')";
                $hasil3 = $conn2->query($sql3);
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
    <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a>
  </div>
  <div class="col col-sm-7">
    <h2>E - Purchase Order</h2>

  </div>
    <form>
      <table class="table table-striped">
        
          <tr>
            <td>Supplier</td>
            <td colspan="2">
              <select name="cari" class="form-control" onchange="this.form.submit()">
          <?php

                while ($r2 = $hasil2->fetch()) {
                 

                        ?>
                                  <option <?php echo !empty($_GET['cari']==$r2['POsuplier'])?'selected':''; ?> value="<?php echo $r2['POsuplier']; ?>"><?php echo $r2['SupName']; ?></option>

                                  <?php
              $no++;
              }

                    ?>



               
              </select>
               </form>  
            </td>
            <td>
       
              
          </tr>
          <form>
          <tr>
            <td></td>
          <td><div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="awal" value="<?php echo !empty($_GET['awal'])?$_GET['awal']:date('2018-01-01');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div></td>
          <td><div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="akhir" value="<?php echo !empty($_GET['akhir'])?$_GET['akhir']:date('2018-12-31');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div></td>
        </tr>
       
              
          <tr>
            
            <td>Salesman</td>
            <td colspan="2">
              <input type="hidden" name="cari" value="<?php echo $idsup ?>">
              <select name="cari2" class="form-control">
          <?php

                while ($r2 = $hasil3->fetch()) {
                 

                        ?>
                        <option <?php echo !empty($_GET['cari2']==$r2['POSalesId'])?'selected':''; ?> ><?php echo $r2['POSalesId']; ?></option>

                                  <?php
              $no++;
              }

                    ?>



               
              </select>
             

            </td>

            </tr>

      </table>
      <center> <button type="submit" class="btn btn-danger right">Search</button></center>
        </form>
                <?php
      if (!empty($_GET['cari'])) {
          $cari = $_GET['cari'];
          $cari2 = $_GET['cari2'];


 $sql="select PRPOHd.POsuplier,SupName,POSalesId,convert(varchar, PODate, 103) as PODate,PONmbr
from PRPOHd inner join SmSupplierMS on PRPOHd.POsuplier = SmSupplierMS.supId 
WHERE PRPOHd.PODate between '$awal' and '$akhir' and PRPOHd.POsuplier in ('$cari') and PRPOHd.POSalesID in('$cari2')";
}


            ?> 
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
               <thead>
       <tr>
        <th data-priority="3">Nomor Purchase ORder</th>
        <th>Supplier</th>
         
         <th>Sales</th>
         <th data-priority="3">Tanggal</th>
         <th></th>
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;


  
  $hasil = $conn2->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td><a href="list_data.php?id=<?php echo $data['PONmbr'];?>" ><?php echo $data['PONmbr']; ?></a></td>
    <td><?php echo $data['SupName']; ?></td>
    <td><?php echo $data['POSalesId']; ?></td>
    <td><?php echo $data['PODate']; ?></td>
    <td>
      <a href="po_csv.php?id=<?php echo $data['PONmbr']?>"><i class="fa fa-download"></i> Download</a>
    </td>

  
  

  </tr>
  <?php 
$total  += $data['Total'];
  $no++;} ?>


     </tbody>
            </table>
          

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