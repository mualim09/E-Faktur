<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once 'koneksi.php';

if (!empty($_POST['nm_user'])) {
    

    $sqlKode = "select kd_user from master_user order by kd_user DESC limit 1";

    $r = $conn->query($sqlKode)->fetch();

    $kd = $r['kd_user']+1;




    $b = $_POST['nm_user'];
    $c = sha1($_POST['pass']);
    $d = $_POST['nm_lengkap'];
    $e = $_POST['level'];




   echo $sql = "INSERT INTO `master_user`
                (`kd_user`,
                 `nm_user`,
                 `pass`,
                 `nm_lengkap`,
                 `level`)
    VALUES ('$kd',
            '$b',
            '$c',
            '$d',
            '$e');";

    if ($conn->query($sql)) {
      
      header('location:user.php?status=ok');
      
  }

}


include_once 'header.php';


      if(!empty($_GET['status']) && $_GET['status'] ='ok')
                {
                  echo '<script>sweetAlert("Berhasil..", "Data di update !", "success");</script>';
                  
                }
                
                
?>

<div class="col col-sm-12">
<center><h2><strong>Tambah User Baru</strong></h2></center>
                       <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                             <a href="user.php" class="btn btn-default" ><i class="fa fa-arrow-left"> </i> Kembali</a>
                               </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form"  action="" method="post">
                                                <table class="table table-striped table-bordered table-responsive">
                                                  <tr>
                                                    <td>Username</td>
                                                    <td>
                                                    <input id="nm_user" name="nm_user" class="form-control" type="text" placeholder="masukan username" required="required">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Nama Lengkap</td>
                                                    <td><input id="nm_lengkap" name="nm_lengkap" class="form-control"  type="text" placeholder="masukan nama lengkap">
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>Password</td>
                                                    <td><input id="pass" name="pass" class="form-control"  type="password" placeholder="masukan password"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Level</td>
                                                    <td>
                                                    <select class="form-control" id="level" name="level">
                                                      <option>Admin</option>
                                                      <option>Biasa</option>
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
