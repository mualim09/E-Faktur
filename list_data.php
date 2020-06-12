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

?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
    <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a>
  </div>
  <div class="col col-sm-7">
    <h2>LIHAT LAPORAN PEMBELIAN SUPPLIER</h2>

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
                                  <option <?php echo !empty($_GET['cari']==$r2['GRNsupplier'])?'selected':''; ?> value="<?php echo $r2['GRNsupplier']; ?>"><?php echo $r2['SupName']; ?></option>

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
                                            <input class="form-control tgl"  name="awal" value="<?php echo !empty($_GET['awal'])?$_GET['awal']:date('2017-01-01');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div></td>
          <td><div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="akhir" value="<?php echo !empty($_GET['akhir'])?$_GET['akhir']:date('2017-12-31');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div></td>
        </tr>
       
              
          <tr>
            
            <td>Salesman</td>
            <td colspan="2">
              <input type="hidden" name="cari" value="<?php echo $idsup ?>">
              <select name="cari2" class="form-control" onchange="this.form.submit()">
          <?php

                while ($r2 = $hasil3->fetch()) {
                 

                        ?>
                                  <option <?php echo !empty($_GET['cari']==$r2['SalesId'])?'selected':''; ?> value="<?php echo $r2['SalesId']; ?>"><?php echo $r2['SalesId']; ?></option>

                                  <?php
              $no++;
              }

                    ?>



               
              </select>
             

            </td>

            </tr>
      </table>
        </form>
                <?php
      if (!empty($_GET['cari'])) {
          $cari = $_GET['cari'];
          $cari2 = $_GET['cari2'];


$sql="select PRGRNHd.GRNsupplier,SupName,SalesId,convert(varchar, GRNDate, 103) as GRNDate,PRGRNDt.GrnNmbr, Convert(float,SUM(GRNNEttoHC)) as Total 
from dbo.PRGRNdT inner join PRGRNHd on 
PRGRNHd.GRNnmbr=PRGRNDt.GRNNmbr inner join SmSupplierMS on PRGRNHd.GRNsupplier = SmSupplierMS.supId 
WHERE PRGRNHd.GRNDate between '$awal' and '$akhir' and PRGRNHd.GRNsupplier in ('$cari') and PRGRNHd.SalesID in('$cari2')
GROUP By PRGRNDt.GrnNmbr,GRNsupplier,GRNDate,SupName,SalesId order by PRGRNHd.GRNDate ASC";
}


            ?> 
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
               <thead>
       <tr>
        <th data-priority="3">GRN</th>
         <th data-priority="3">Tanggal</th>
         <th data-priority="1"><abbr title="Rotten Tomato Rating">Total</abbr></th>
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;


  
  $hasil = $conn2->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td><a href="list_data.php?id=<?php echo $data['GrnNmbr'];?>" ><?php echo $data['GrnNmbr']; ?></a></td>
    <td><?php echo $data['GRNDate']; ?></td>
    <td><?php echo number_format($data['Total']); ?></td>

  
  

  </tr>
  <?php 
$total  += $data['Total'];
  $no++;} ?>


     </tbody>
            </table>

<div class="container">
  <h1 class="text-right"><?php echo "Rp. ".number_format($total) ?></h1>
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