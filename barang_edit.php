<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once 'koneksi.php';
      
if (!empty($_POST['sku'])) {
  

     echo $id = $_POST['sku'];

          
          $b = $_POST['nm'];
          $c = str_replace('.', '', $_POST['hrg']);
          $d = $_POST['stk'];
          $e = $_POST['uom'];
          $f = $_POST['bar'];
          $g = $_POST['ppn'];

          echo $sql = "UPDATE barang SET nm='$b',hrg='$c', stk='$d',uom='$e',bar='$f',ppn='$g' WHERE sku='$id'";
          try {
            if ($conn->query($sql)) {
            
            header('location:barang.php?status=okdit');
            
        }
            
          } catch (Exception $e) {

            echo $err = $e->getMessage();
    header('location:barang.php?status=err&txt='.$err.'');
            
          }

            
      

      }

else{

  $id = $_GET['id'];

    $sqlKode = "select * from barang where sku='$id'";

    $r = $conn->query($sqlKode)->fetch();

}

  




include_once 'header.php';

                
                
?>

<div class="col col-sm-12">

<center><h2><strong>Edit Barang</strong></h2></center>
                       <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                             <a href="barang.php" class="btn btn-default" ><i class="fa fa-arrow-left"> </i> Kembali</a>
                               </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form"  action="" method="post">
                                            <table class="table table-striped table-bordered table-responsive">
                                             <tr>
                                                    <td>Barocde</td>
                                                    <td><input id="bar" name="bar" class="form-control"  type="text" value="<?php echo $r['bar']?>"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Nama Barang</td>
                                                    <td><input type="hidden" name="sku" value="<?php echo $r['sku']?>">
                                   <input id="nm" name="nm" class="form-control" type="text" required="required" value="<?php echo $r['nm']?>"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Harga</td>
                                                    <td><input id="hrg" name="hrg" class="form-control"  type="text" value="<?php echo $r['hrg']?>"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Stok</td>
                                                    <td><input id="stk" name="stk" class="form-control"  type="text" value="<?php echo $r['stk']?>"></td>
                                                  </tr>

                                                  <tr>
                                                    <td>Uom</td>
                                                    <td><select class="form-control" id="uom" name="uom">
                                                  <option <?php echo  $r['uom']=='PCS'?'selected=selected':'' ?> >PCS</option>
                                                  <option <?php echo $r['uom']=='KG'?'selected=selected':'' ?>>KG</option>
                                               </select>
                                               </td>
                                                  </tr>
                                                  <tr>
                                                    <td>PPN</td>
                                                    <td><select class="form-control" id="ppn" name="ppn">
                                                  <option <?php echo  $r['ppn']=='Y'?'selected=selected':'' ?>  value="Y" >PPN</option>
                                                  <option <?php echo $r['ppn']=='N'?'selected=selected':'' ?> value="N" >NON-PPN</option>
                                               </select>
                                               </td>
                                                  </tr>
                                                  <tr>
                                                    <td></td>
                                                    <td><button onClick="return confirm('Apakah Anda yakin, akan Menyimpan ini ?');" type="submit" class="kon btn btn-primary btn-sm">
                                            <u>S</u>impan</button>
                                             <button type="reset" class="btn btn-default btn-sm">
                                            <u>R</u>eset</button></td>
                                                  </tr>
                                              </table>
                                </form>
                            </div>
                            <div class="panel-footer">
                               
                                
                            </div>
                        </div>
                    </div>
                </div>
</div>
 <script src="library/curr.js"></script>
