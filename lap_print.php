<?php
session_start();
error_reporting(0);
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

include_once 'koneksi.php';

if (!empty($_GET['q'])) {
    
    $q= $_GET['q'];
    $q2= $_GET['q2'];
    $q3= $_GET['q3'];
    $brt= $_GET['brt'];
    $dsc= $_GET['dsc'];
    $ppn= $_GET['ppn'];
    $awal= $_GET['awal'];
    $akhir= $_GET['akhir'];
}
         
                
?>
<body onload="window.print()">
<div class="col col-sm-4">
  <img src="images/brand.png" width="120" height="50">
</div>
<div class="col col-sm-12">
</div>
<div class="col col-sm-12">
  <center><h2>AZERAF STORE</h2>
  <h3>Jl. Cisaranten Kulon No. 10</h3></center>
  <hr>
<h3>
  
  <?php


      echo "Periode ".Indonesia3Tgl($awal)." s/d ".Indonesia3Tgl($akhir);
?>
</h3>
 <table style="background-color: #FFF" class="display table table-striped table-hover table-bordered" width="100%" cellspacing="0" >
                <thead>
                <tr class="bg bg-primary" style="background-color:  ">
                  <th width="3%">No.</th>
                  <th>Tanggal</th>
                  <th>SKU </th>
                  <th>Nama Barang</th>
                  <th>Qty </th>
                  <th>UOM</th>
                  <th>Harga </th>
                  <th>Bruto</th>
                  <th>Disc(%)</th>
                  <th>Amount</th>
                  <th>PPN</th>
                   <th>SubTotal</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
                 $no=1;
                  $sql =$conn->query($q);
                  


                        

                     
                  
                  while($r = $sql->fetch()){

                  
              ?>
              <tr>
               <td><?php echo $no; ?></td>
                <td><?php echo Indonesia3Tgl($r['tgl'])." ".$r['tm'];; ?></td>
                <td><?php echo $r['id_barang']; ?></td>
                <td><?php echo $r['nm']; ?></td>
                <td><?php echo number_format($r['qty']); ?></td>
                <td><?php echo $r['uom']; ?></td>
                 <td><?php echo number_format($r['hrg']); ?></td>
                 <td><?php echo number_format($r['brt']); ?></td>
                  <td><?php echo number_format($r['disc']); ?></td>
                   <td><?php echo number_format($r['discA']); ?></td>
                    <td><?php echo number_format($r['ppn']); ?></td>
                
                <td><?php echo number_format($r['tot']); ?></td>
              </tr>
              <?php 


              $no++; 

            }
              ?>
              <tr>
               <td colspan="4"><?php 

                  $sql2 =$conn->query($q2)->fetch();
                  $brt =$conn->query($brt)->fetch();
                  $dsc =$conn->query($dsc)->fetch();
                  $ppn =$conn->query($ppn)->fetch();
                  $sql2 =$conn->query($q2)->fetch();

                  $sql3 =$conn->query($q3)->fetch(); ?>
                    
                  </td>
    
                <td class="bg info"><?php echo number_format($sql2['qty_all']); ?></td>
                <td colspan="2"></td>
                <td class="bg info"><?php echo number_format($brt['brt']); ?></td>
                <td colspan="1"></td>
                <td class="bg info"><?php echo number_format($dsc['dsc']); ?></td>
                <td class="bg info"><?php echo number_format($ppn['ppn']); ?></td>
                <td class="bg info"><?php echo number_format($sql3['tot_all']); ?></td>
              </tr>
              
              </tbody>
            </table>

</div>  
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