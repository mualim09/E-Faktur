<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

include_once 'koneksi.php';
include_once 'header.php';


    
                
                
                
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">
 <?php if($_SESSION['level']=="Admin"){?>
    <a href="barang_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a>
      <?php }?>
  </div>
  <div class="col col-sm-7">
    <h2>DATA BARANG</h2>
  </div>
                   
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
                <thead>
                <tr class="bg bg-primary" style="background-color:  ">
                  <th width="3%">No.</th>
                  <th>SKU</th>
                  <th>Barcode</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>UOM</th>
                  <th>PPN</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
                 $no=1;
                  $sql =$conn->query("select * from barang");
                  
                  while($r = $sql->fetch()){
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r['sku']; ?></td>
                <td><?php echo $r['bar']; ?></td>
                <td><?php echo $r['nm']; ?></td>
                <td><?php echo number_format($r['hrg']); ?></td>
                <td><?php echo number_format($r['stk']); ?></td>
                <td><?php echo $r['uom']; ?></td>
                <td><?php echo $r['ppn']; ?></td>

                <td class="ctr">
                  <div class="btn-group">
 <?php if($_SESSION['level']=="Admin"){?>
                    <a href="barang_lihat.php?id=<?php echo  $r['sku']; ?>" data-toggle="tooltip" data-placement="left" title="Lihat" class="btn btn-primary">
                    <i class="fa fa-search"> </i></a>&nbsp;

                     <a href="barang_edit.php?id=<?php echo  $r['sku']; ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success">
                    <i class="fa fa-pencil"> </i></a>&nbsp;


                    <a onClick="return confirm('Apakah Anda yakin, akan Hapus ini ?');"  class="btn btn-danger" href="barang_hapus.php?id=<?php echo  $r['sku']; ?>" data-toggle="tooltip" data-placement="right" title="Hapus" >
                    <i class="fa fa-trash"> </i></a>&nbsp;

  <?php }?>

                  </div>
                </td>
              </tr>
              <?php 


              $no++; 

            }
              ?>
              
              </tbody>
            </table>

</div>  
