<!DOCTYPE html>
<html>
<body>
<?php
// session_start();
// if (empty($_SESSION['nm_user'])) {
    
//     header("location:login.php");
// }

error_reporting(0);
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
<div class="col col-sm-5">
  <a class="btn btn-danger" href="pajak_add.php"><i class="fa fa-search"></i> CEK FAKTUR PAJAK</a>
  </div>
  <div class="col col-sm-7">
    <h2>Scan QR Barcode</h2>

  </div>
  
      <table class="table table-striped">
      <label><input type="checkbox" name="cr" value="1" checked="checked">Dapat Dikreditkan</label>
          <tr>
            <td>Scan Barcode</td>
            <td>
                  <input autofocus type="text" id="urlPajak" name="bar" placeholder="scan barcode faktur" class="form-control">
            </td>
            <td>
            
             
            </td>
            <td>
              
            </td>
          </tr>
      </table>
<hr>
<div id="data">
  
</div>


            
<!-- hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
    <thead>
       <tr>
        <th>No</th>
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
         <th>TANGGAL_SCAN</th>
         <th></th>
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;
$sql="select * from pajak where UPD='".date('Y-m-d')."' limit 1";

  
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td><?php echo $no; ?></td>
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
       <td><?php echo $data['UPD']; ?></td>
    <td><a class="btn btn-danger" href="pajak_hapus.php?id=<?php echo $data['NOMOR_FAKTUR']; ?>">Hapus</a></td>

  
  

  </tr>
  <?php $no++;} ?>


     </tbody>
            </table> -->

</div>  
<script type="text/javascript" language="javascript">
$(document).ready(function() {

    $('.tabza').DataTable();
   


  
  $("#urlPajak").on('change',function(){

    var id = $(this).val();

      $.ajax({
        url:'load_pajak.php',
        type:'post',
        data : {id : id},
        success:function(data){
          $("#urlPajak").focus();
          $('#data').html(data);
          $("#urlPajak").val("");



        }

      })

  });
  
});


  
  


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