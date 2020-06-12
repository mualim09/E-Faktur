<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once 'koneksi.php';

$id = $_GET['id'];

    $sqlKode = "select * from kantor where npwp='$id'";

    $r = $conn->query($sqlKode)->fetch();     
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
                                                    <input disabled="disabled" name="npwp" class="form-control" type="text" placeholder="masukan npwp" required="required" value="<?php echo $r['npwp'] ?>">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Nama Perusahaan</td>
                                                    <td><input disabled="disabled"  name="nama" class="form-control"  type="text" placeholder="masukan nama perusahaan" value="<?php echo $r['nama'] ?>">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Telepon</td>
                                                    <td><input disabled="disabled"  name="telp" class="form-control"  type="text" placeholder="masukan telepon" value="<?php echo $r['telp'] ?>"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Fax</td>
                                                    <td><input disabled="disabled"  name="fax" class="form-control"  type="text" placeholder="masukan fax" value="<?php echo $r['fax'] ?>"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Alamat</td>
                                                    <td><input disabled="disabled"  name="alamat" class="form-control"  type="text" placeholder="masukan alamat" value="<?php echo $r['alamat'] ?>"></td>
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
