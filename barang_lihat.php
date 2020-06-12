<?php 
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once '../koneksi.php';
      

      $id = $_GET['id'];

    $sqlKode = "select * from barang where sku='$id'";

    $r = $conn->query($sqlKode)->fetch();



include_once 'header.php';

                
                
?>

<div class="col col-sm-12">
<center><strong><h2>Lihat Barang</h2></strong></center>
                       <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <a href="barang.php" class="btn btn-default" ><i class="fa fa-arrow-left"> </i> Kembali</a>
                                <a href="barang_edit.php?id=<?php echo $r['sku']?>" class="btn btn-primary" ><i class="fa fa-pencil"> </i> Edit</a>
                               </div>
                                        <div class="panel-body">
                                          
                                              <table class="table table-striped table-bordered table-responsive">
                                                  <tr>
                                                    <td>Sku</td>
                                                    <td><?php echo $r['sku']?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Barcode</td>
                                                    <td><?php echo $r['bar']?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Nama Barang</td>
                                                    <td><?php echo $r['nm']?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Harga</td>
                                                    <td><?php echo number_format($r['hrg']);?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Stok</td>
                                                    <td><?php echo number_format($r['stk']);?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>UOM</td>
                                                    <td><?php echo $r['uom']?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>PPN</td>
                                                    <td><?php echo $r['PPN']?></td>
                                                  </tr>
                                              </table>

                                        </div>
                            
                                        <div class="panel-footer">
                                        </div>
                        </div>
                    </div>
                </div>
</div>
