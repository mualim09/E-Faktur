<?php
session_start();
error_reporting(1);
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

include_once 'koneksi.php';
include_once 'header.php';
if (!empty($_GET['awal']) && !empty($_GET['akhir'])) {
    
  $awal = $_GET['awal'];
  $akhir  = $_GET['akhir'];
     $q="SELECT*FROM _lap WHERE tgl between '$awal' and '$akhir';";

    $q2="SELECT sum(qty) as qty_all FROM _lap WHERE tgl between '$awal' and '$akhir';";
    $brt="SELECT sum(brt) as brt FROM _lap WHERE tgl between '$awal' and '$akhir';";
    $dsc="SELECT sum(discA) as dsc FROM _lap WHERE tgl between '$awal' and '$akhir';";
    $ppn="SELECT sum(ppn) as ppn FROM _lap WHERE tgl between '$awal' and '$akhir';";

    $q3="SELECT sum(tot) as tot_all FROM _lap WHERE tgl between '$awal' and '$akhir';";


}
              
              else{

                $q='select * from _lap where id=0';
                $q2="SELECT sum(qty) as qty_all FROM _lap WHERE id=0;";
                $q3="SELECT sum(tot) as tot_all FROM _lap WHERE id=0;";
                $brt="SELECT sum(brt) as brt FROM _lap WHERE id=0;";
            $dsc="SELECT sum(discA) as dsc FROM _lap WHERE id=0;";
            $ppn="SELECT sum(ppn) as ppn FROM _lap WHERE id=0;";

              }     
                
?>
<div class="row">
    <div class="col col-sm-12">
<center>
      <form action="lap_print.php" style="display: inline;">  
                          <textarea style="display:none;" name="q"><?php echo $q;?></textarea>
                          <textarea style="display:none;" name="q2"><?php echo $q2;?></textarea>
                          <textarea style="display:none;" name="q3"><?php echo $q3;?></textarea>
                          <textarea style="display:none;" name="brt"><?php echo $brt;?></textarea>
                          <textarea style="display:none;" name="dsc"><?php echo $dsc;?></textarea>
                          <textarea style="display:none;" name="ppn"><?php echo $ppn;?></textarea>
                          <input type="hidden" name="awal" value="<?php echo $awal;?>">
                          <input type="hidden" name="akhir" value="<?php echo $akhir;?>">
                            <button type="SUBMIT" class="btn btn-primary">
                            <i class="fa fa-print"> </i> Print</button>&nbsp;
                  </form>

</center>
    
  </div>



<div class="col col-sm-12">
    <center><h2>LAPORAN PENJUALAN</h2></center>
    

               <form>
                  <table class="table">
                   <!--   <tr>
                       <td>Kata Kunci</td>
                      <td>
                          <input type="" name="cari" class="form-control" placeholder="masukan kata kunci">
                      </td>
                      <td></td>
                      <td>
                          
                      </td>
                     </tr> -->
                     <tr>
                     
                  <td>From</td>
                  <td>
                      <div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="awal" value="<?php echo !empty($_GET['awal'])?$_GET['awal']:date('Y-m-d');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div>

                   </td>
                   <td>To</td>
                  <td>
                          <div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="akhir" value="<?php echo !empty($_GET['akhir'])?$_GET['akhir']:date('Y-m-d');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div>

                  </td>
                  <td>
                    <input type="SUBMIT" name="ok" value="Cari" class="btn btn-primary">
                  </td>
                </tr>
                  </table>
                 </form>
  </div>



                   
<hr>

<div class="container-fluid">
<center>
  <h3>
  
  <?php


      echo "Periode ".Indonesia3Tgl($awal)." s/d ".Indonesia3Tgl($akhir);
?>
</h3>
</center>
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