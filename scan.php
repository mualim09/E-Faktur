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


  

                        
                
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
  </div>
  <div class="col col-sm-7">
    <h2>Barcode Barang</h2>

  </div>
        <form>
      <table class="table table-striped">
          <tr>
            <td>Scan Barcode</td>
            <td>
             <input autofocus type="text" id="bar2" name="bar" placeholder="scan barcode product" class="form-control" onchange="this.form.submit()"  >
        </form>  
            </td>
            <td>
            <?php
            if (!empty($_GET['bar'])) {
  $bar = $_GET['bar'];
  $sql="INSERT INTO bar2 VALUES('$bar')";
 if ($conn->query($sql)) {
    header('location:scan.php');
 }

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
        <th>No</th>
         <th data-priority="2">Bar</th>
	<th></th>
       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;
$sql="select * from bar2";

  
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {
   
   ?> 
  <tr>  
    <td><?php echo $no; ?></td>
    <td><?php echo $data['bar']; ?></td>
    <td><a class="btn btn-danger" onClick="return confirm('Apakah Anda yakin, akan Hapus ini ?');" href="scan_hapus.php?id=<?php echo $data['bar'];?>" ><i class="fa fa-trash"></i></a></td>
	
  

  </tr>
  <?php $no++;} ?>


     </tbody>
            </table>

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