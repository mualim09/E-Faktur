<!DOCTYPE html>
<html>
<body>
<?php
set_time_limit(0);
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

error_reporting(1);
include_once 'koneksi.php';
include_once 'koneksi2.php';
include_once 'header.php';
include_once 'phpqrcode/qrlib.php';


if (!empty($_GET['err'])) {
    echo '<script type="text/javascript">
  alert("Faktur Sudah Di Scan")
</script>';
  }  

                        
                
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5"> </div>
  <div class="col col-sm-7">
    <h2>CEK MASA FAKTUR PAJAK</h2>

  </div>
        <form>
        <table class="table">
          <tr>
            <td>Tanggal Scan</td>
          <td><div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="awal" value="<?php echo !empty($_GET['awal'])?$_GET['awal']:date('Y-m-d');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div></td>
          <td><div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="akhir" value="<?php echo !empty($_GET['akhir'])?$_GET['akhir']:date('Y-m-d');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div></td>
                                          <td><button type="submit" class="btn btn-danger">Search</button></td>
        </tr>
        </table>

        </form>
<hr>

<?php

if (!empty($_GET['awal'])) {
  $awal = $_GET['awal'];
  $akhir = $_GET['akhir'];

  $sql="select * from pajak where UPD between '$awal' and '$akhir'";
}
else{
  $sql="select * from pajak where FM='0' limit 1";
}

?>
<center>
<form action="pajak_export3.php">

      <td>
        <input type="hidden" name="awal" class="form-control" value="<?php echo $awal ?>">
        <input type="hidden" name="akhir" class="form-control" value="<?php echo $akhir ?>">
       <button class="btn btn-success" type="submit">
         <i class="fa fa-file-excel-o"></i> EXPORT EXCEL
       </button>
      </td>
    </tr>
  </table>
</form>
</center>


<hr>
 <div style="overflow:auto">
     <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
    <thead>
       <tr>
        <th>No</th>
        <th>NAMA</th>
        <th>TANGGAL_SCAN</th>
         <th>FM</th>
         <th>NPWP</th>
         <th>NOMOR_FAKTUR</th>
         <th>KONTRABON</th>
         <th>TANGGAL_FAKTUR</th>
         <th>TANGGAL_KONTRABON</th>
         <th>STATUS MASA</th>
         <th>JUMLAH_DPP</th>
         <th>JUMLAH_PPN</th>


         
  <!--        <th>LINK</th> -->
         
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;


  
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {
   
   $NOMOR_FAKTUR_FIX = $data['KD_JENIS_TRANSAKSI'].$data['FG_PENGGANTI']."."
.substr($data['NOMOR_FAKTUR'], 0,3)."-".substr($data['NOMOR_FAKTUR'], 3,2).".".substr($data['NOMOR_FAKTUR'], 5,10);
    $KONTRA = $conn2->query("select top 1 CMTTTDt.TTTNmbr,convert(varchar, TTTDate, 23) TTTDate,GrnNmbr,FPMasukan,convert(varchar, FPDate, 23) FPDate,TTTAmount, TTTAmountPmt from CMTTThd inner join CMTTTdt ON  CMTTTDt.TTTNmbr =  CMTTThd.TTTNmbr WHERE FPMasukan='$NOMOR_FAKTUR_FIX'")->fetch();




$hari_faktur = substr($data['TANGGAL_FAKTUR'], 8,2);
$hari_kontra = substr($KONTRA['TTTDate'], 8,2);

  $tahun_faktur = substr($data['TANGGAL_FAKTUR'], 2,2);
  $bulan_faktur = substr($data['TANGGAL_FAKTUR'], 5,2);
  
  $tahun_kontra = substr($KONTRA['TTTDate'], 2,2);
 $bulan_kontra = substr($KONTRA['TTTDate'], 5,2);

 $tgl_faktur = $tahun_faktur.$bulan_faktur;
 $tgl_kontra = $tahun_kontra.$bulan_kontra;

?>

  <tr>
    <td><?php echo $no; ?></td> 
        <td><?php echo $data['NAMA']; ?></td>
    <td class="success"><?php echo $data['UPD']; ?></td>
    <td><?php echo $data['FM']; ?></td>
    <td><?php echo substr($data['NPWP'], 0,2).".".substr($data['NPWP'], 2,3).".".substr($data['NPWP'], 5,3).".".substr($data['NPWP'], 8,1)."-".substr($data['NPWP'], 9,3).".".substr($data['NPWP'], 12,3) ?></td>
    <td><?php echo $NOMOR_FAKTUR_FIX ?></td>
    <td><?php echo $KONTRA['TTTNmbr']?></td>
    <td><?php echo "<strong>".$tgl_faktur."</strong> ".$hari_faktur ?></td>
    <td><?php echo "<strong>".$tgl_kontra."</strong> ".$hari_kontra; ?></td>

    <td><?php 
    if (empty($KONTRA['TTTNmbr'])) {
      echo "-";
    }
    elseif ($tgl_faktur == $tgl_kontra) {
      echo "MS";
    }
    elseif ($tgl_faktur != $tgl_kontra) {
      $nomor = $bulan_kontra - $bulan_faktur;
      echo "MTS-".$nomor;
    }
    else{
      echo "-";
    }

    ?></td>
    <td><?php echo number_format($data['JUMLAH_DPP']); ?></td>
    <td><?php echo number_format($data['JUMLAH_PPN']); ?></td>

    

    

  
  

  </tr>
  <?php $no++;} ?>


     </tbody>
            </table>
 </div>

</div>  
<script type="text/javascript" language="javascript">
$(document).ready(function() {

    $('.tabza').DataTable();
    $('#bar2').focus();

  
    
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