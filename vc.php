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
WHERE PRPOHd.PODate between '2017-01-01' and '2017-12-31' and PRPOHd.POsuplier in('$idsup')";
                $hasil3 = $conn2->query($sql3);
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
    <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a>
  </div>
  <div class="col col-sm-7">
    <h2>Create Voucher Setiabudhi</h2>

  </div>
    <form action="vc2.php">
      <table class="table table-striped">
        <tr>
            <td>Kode</td> 
            <td>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i> </span>
                    <input name="kode" type="text" class="form-control" placeholder="misal SJA 2018 25" aria-describedby="basic-addon1">
                  </div>
            </td>
            <td>
       
              
          </tr>

          <tr>
            <td>Nomor Dari</td> 
            <td>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-cubes"></i> </span>
                    <input name="awal" type="text" class="form-control" placeholder="from" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-cubes"></i> </span>
                    <input name="akhir" type="text" class="form-control" placeholder="to" aria-describedby="basic-addon1">
                  </div>
            </td>
            <td>
       
              
          </tr>
        
          <tr>
            <td>Harga Voucher</td> 
            <td>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Rp. </span>
                    <input name="hrg" type="text" class="form-control" placeholder="misal 25000" aria-describedby="basic-addon1">
                  </div>
            </td>
            <td>
       
              
          </tr>
          <form>
          <tr>
            <td>Berlaku Sampai</td>
          <td><div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="tgl" value="<?php echo !empty($_GET['akhir'])?$_GET['akhir']:date('2018-12-31');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div></td>
        </tr>
       
            <tr>
              <td></td>
              <td><button type="submit" class="btn btn-danger"><i class="fa fa-credit-card"></i> Create Voucher</button></td>
            </tr>
         </form>

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