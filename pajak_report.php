<!DOCTYPE html>
<html>
<body>
<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

error_reporting(1);
include_once 'koneksi.php';
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
    <h2>LAPORAN SCAN FAKTUR PAJAK</h2>

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

<hr>
 <div style="overflow:auto">
     <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
    <thead>
       <tr>
        <th>No</th>
       <th></th>
        
        <th>SUDAH EXPORT ?</th>
        <th>TANGGAL_SCAN</th>
         <th>FM</th>
         <th>KD_JENIS_TRANSAKSI</th>
         <th>FG_PENGGANTI</th>
         <th>NOMOR_FAKTUR</th>
         <th>MASA_PAJAK</th>
         <th>TAHUN_PAJAK</th>
         <th>TANGGAL_FAKTUR</th>
         <th>NPWP</th>
         <th>NAMA</th>
         <th>ALAMAT_LENGKAP</th>
         <th>JUMLAH_DPP</th>
         <th>JUMLAH_PPN</th>
         <th>JUMLAH_PPNBM</th>
         <th>IS_CREDITABLE</th>
         
  <!--        <th>LINK</th> -->
         
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;


  
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>
    <td><?php echo $no; ?></td>
    <td>

      <div>
        <div class="col-md-6">
        <a class="btn btn-primary" href="pajak_lihat.php?bar=<?php echo $data['BAR']; ?>"><i class="fa fa-search"></i></a>
      </div>
      <div class="col-md-6">
        <a class="btn btn-danger" href="pajak_hapus.php?bar=<?php echo $data['NOMOR_FAKTUR']; ?>"><i class="fa fa-trash"></i></a>
      </div>
      </div>
      
 
    </td>
    <td>

      <button class="btn <?php echo $data['EXPORT']=='Y'?'btn-success':'btn-danger'; ?>"><?php echo $data['EXPORT']=='Y'?'SUDAH':'BELUM'; ?></button>

    </td>  
    
    <td class="success"><?php echo $data['UPD']; ?></td>
    <td><?php echo $data['FM']; ?></td>
    <td><?php echo $data['KD_JENIS_TRANSAKSI']; ?></td>
    <td><?php echo $data['FG_PENGGANTI']; ?></td>
    <td><?php echo $data['NOMOR_FAKTUR']; ?></td>
    <td><?php echo $data['MASA_PAJAK']; ?></td>
    <td><?php echo $data['TAHUN_PAJAK']; ?></td>
    <td><?php echo $data['TANGGAL_FAKTUR']; ?></td>
    <td><?php echo $data['NPWP']; ?></td>
    <td><?php echo $data['NAMA']; ?></td>
    <td><?php echo $data['ALAMAT_LENGKAP']; ?></td>
    <td><?php echo $data['JUMLAH_DPP']; ?></td>
    <td><?php echo $data['JUMLAH_PPN']; ?></td>
    <td><?php echo $data['JUMLAH_PPNBM']; ?></td>
    <td><?php echo $data['IS_CREDITABLE']; ?></td>
    
   <!--  <td><?php echo $data['BAR']; ?></td> -->
    

  
  

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