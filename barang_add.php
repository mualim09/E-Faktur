<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once 'koneksi.php';

if (!empty($_POST['nm'])) {
    

    // $sqlKode = "select sku from barang order by sku DESC limit 1";

    // $r = $conn->query($sqlKode)->fetch();

    $kd = $_POST['sku'];
    $b = $_POST['nm'];
    $c = str_replace('.', '', $_POST['hrg']);
    $d = $_POST['stk'];
    $e = $_POST['uom'];
    $f = $_POST['bar'];
    $g = $_POST['ppn'];


 
       echo $sql = "INSERT INTO `barang`
      VALUES ('$kd',
              '$b',
              '$c',
              '$d',
              '$e','$f','$g');";


               try {

               if ($conn->query($sql)) {
        
                          header('location:barang.php?status=ok');
                          
                      }

          
        } catch (Exception $e) {

          // Note The Typecast To An Integer!


    echo $err = $e->getMessage();
    header('location:barang.php?status=err&txt='.$err.'');
          
        }




   

}


include_once 'header.php';


      if(!empty($_GET['status']) && $_GET['status'] ='ok')
                {
                  echo '<script>sweetAlert("Berhasil..", "Data di update !", "success");</script>';
                  
                }
                
                
?>

<div class="col col-sm-12">
<center><h2><strong>Tambah Barang Baru</strong></h2></center>
                       <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                             <a href="barang.php" class="btn btn-default" ><i class="fa fa-arrow-left"> </i> Kembali</a>
                               </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form"  action="" method="post">
                                                <table class="table table-striped table-bordered table-responsive">
                                                  <tr>
                                                    <td>SKU</td>
                                                    <td>
                                                    <input maxlength="11" id="sku" name="sku" class="form-control" type="text" placeholder="masukan sku" required="required">
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td>Barcode</td>
                                                    <td>
                                                    <input  id="bar" name="bar" class="form-control" type="text" placeholder="masukan barcode" required="required">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Nama Barang</td>
                                                    <td><input id="nm" name="nm" class="form-control"  type="text" placeholder="masukan nama barang">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Harga</td>
                                                    <td><input id="hrg" name="hrg" class="angka  form-control"  type="text" placeholder="masukan harga"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Stok</td>
                                                    <td><input id="stk" name="stk" class="angka form-control"  type="text" placeholder="masukan stok"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Uom</td>
                                                    <td>
                                                    <select class="form-control" id="uom" name="uom">
                                                      <option>PCS</option>
                                                      <option>KG</option>
                                                 </select>
                                               </td>
                                                <tr>
                                                    <td>PPN</td>
                                                    <td>
                                                    <select class="form-control" id="ppn" name="ppn">
                                                      <option value="Y">PPN</option>
                                                      <option value="N">NON-PPN</option>
                                                 </select>
                                               </td>
                                                  </tr>
                                                  <tr>
                                                    <td></td>
                                                    <td>
                                                          <button onClick="return confirm('Apakah Anda yakin, akan Menyimpan ini ?');" type="submit" class="kon btn btn-primary btn-sm">
                                                          <u>S</u>impan</button>
                                                           <button type="reset" class="btn btn-default btn-sm">
                                                          <u>R</u>eset</button>
                                                    </td>
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
  <script src="library/stk.js"></script>