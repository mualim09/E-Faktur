<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once 'koneksi.php';
      
if (!empty($_POST['npwp'])) {
  

     echo $id = $_POST['npwp'];
         $a = $_POST['npwp'];
          $b = $_POST['nama'];
          $c = $_POST['telp'];
          $d = $_POST['fax'];
           $e = $_POST['alamat'];

echo $sql = "UPDATE kantor SET nama='$b',telp='$c', fax='$d',alamat='$e',npwp='$a' WHERE npwp='$id'";

            if ($conn->query($sql)) {
            
            header('location:kantor.php?status=okdit');
            
            }
      
    



}
else{

  $id = $_GET['id'];

    $sqlKode = "select * from kantor where npwp='$id'";

    $r = $conn->query($sqlKode)->fetch();

}

  




include_once 'header.php';

                
                
?>

<div class="col col-sm-12">
                       <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                             <a href="kantor.php" class="btn btn-default" ><i class="fa fa-arrow-left"> </i> Kembali</a>
                               </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form"  action="" method="post">
                                                <table class="table table-striped table-bordered table-responsive">
                                                  <tr>
                                                    <td>NPWP</td>
                                                    <td>
                                                    <input name="id" class="form-control" type="hidden" placeholder="masukan npwp" required="required" value="<?php echo $r['npwp'] ?>">
                                                    <input name="npwp" class="form-control" type="text" placeholder="masukan npwp" required="required" value="<?php echo $r['npwp'] ?>">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Nama Perusahaan</td>
                                                    <td><input   name="nama" class="form-control"  type="text" placeholder="masukan nama perusahaan" value="<?php echo $r['nama'] ?>">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Telepon</td>
                                                    <td><input   name="telp" class="form-control"  type="text" placeholder="masukan telepon" value="<?php echo $r['telp'] ?>"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Fax</td>
                                                    <td><input   name="fax" class="form-control"  type="text" placeholder="masukan fax" value="<?php echo $r['fax'] ?>"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Alamat</td>
                                                    <td><input   name="alamat" class="form-control"  type="text" placeholder="masukan alamat" value="<?php echo $r['alamat'] ?>"></td>
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

