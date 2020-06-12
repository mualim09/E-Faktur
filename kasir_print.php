<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once 'koneksi.php';

$id = $_GET['id'];
 $sqlKode="SELECT* FROM _lap WHERE id='$id'";

    $q2="SELECT sum(qty) as qty_all FROM _lap WHERE id='$id';";

    $q3="SELECT sum(brt) as brt FROM _lap WHERE id='$id';";
    $q4="SELECT sum(discA) as discA FROM _lap WHERE id='$id';";
    $q5="SELECT sum(tot) as tot_all FROM _lap WHERE id='$id';";

$r = $conn->query($sqlKode)->fetch();
$r2 = $conn->query($q2)->fetch();
$r3 = $conn->query($q3)->fetch();
$rd = $conn->query($q4)->fetch();
$r5 = $conn->query($q5)->fetch();


$kode = explode("/", $id);

?>
<body onload="window.priant()">
<div class="col col-sm-4">
	<center><h4>JUDUL ATAU NAMA PERUSAHAAN</h4>
	<h5>Jl.Alamat No tlp fll</h5></center>	
<table class="table table-striped">
                                      <tr>
                                     
                                        <td>Kode</td>
                                        <td><?php echo $r['id'];?></td>
                                         <td></td>
                                        <td>Kasir</td>
                                        <td><?php echo $kode['1'];?></td>
                                      </tr>
                                       <tr>

                                        <td>Tanggal</td>
                                        <td><?php echo Indonesia3Tgl($r['tgl']);?></td>
                                        <td></td>
                                        <td>Pukul</td>
                                        <td><?php echo $r['tm'];?></td>
                                      </tr>
                                      <tr>
                                        <td colspan="5"><center>*List barang</center></td>
                                      </tr>
                                        <?php
              
                                                     $no=1;
                                                      $sql =$conn->query("select * from _pos_dt where id='$id'");
                                                      
                                                      
                                                      while($r4 = $sql->fetch()){
                                                  ?>
                                      <tr>
                                    
                                        <td>
                                          <?php echo $r4['id_barang'];?>
                                        </td>
                                        <td colspan="4"><?php echo $r4['nm'];?></td>

                                      </tr>
                                      <tr>
                                        <td>
                                          <?php echo number_format($r4['hrg']);?>
                                        </td>
                                        <td><?php echo "x ". number_format($r4['qty']);?></td>
                                        <td><?php echo "Disc.".number_format($r4['disc'])."%";?></td>
                                        <td><?php echo $r4['uom'];?></td>
                                        <td><?php echo number_format($r4['tot']);?></td>
                                      </tr>
                                 <?php

                                  $no++;}
                                 ?>
                                 <tr>
                                   <td colspan="5"></td>

                                 </tr>
                                  <tr>
                                   <tr>
                                    <td>Items</td>
                                    <td><?php echo $no-1; ?></td>
                                    <td>Bruto</td>
                                      <td></td>
                                      <td><?php 
                                    
                                      echo number_format($r3['brt'])?></td>
                                    </tr>
                                 </tr>
                                 <tr>
                                   <tr>
                                    <td></td>
                                    <td></td>
                                    
                                      <td>Discount</td>
                                      <td><?php 
                                    
                                      echo number_format($rd['discA'])?></td>
                                      <td></td>
                                    </tr>
                                 </tr>
                                 <tr>
                                   <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                      <td></td>
                                      <td><?php 
                                    
                                      echo number_format($r5['tot_all'])?></td>
                                    </tr>
                                 </tr>
                                 
                                    </table>
                               <hr>
                          
<table width=100%>
 
</table>
<a href="kasir.php">Kembali</a>      
                           
                              
</div>