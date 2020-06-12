<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}



include_once 'koneksi.php';
      
if (!empty($_POST['kd_user'])) {
  

     echo $id = $_POST['kd_user'];

      if (!empty($_POST['pass'])) {

          $c = sha1($_POST['pass']);
          $b = $_POST['nm_user'];
          
          $d = $_POST['nm_lengkap'];
          $e = $_POST['level'];

          echo $sql = "UPDATE master_user SET nm_user='$b',pass='$c', nm_lengkap='$d',level='$e' WHERE kd_user='$id'";

            if ($conn->query($sql)) {
            
            header('location:user.php?status=okdit');
            
        }
      }
      else
      {
          $b = $_POST['nm_user'];
          $d = $_POST['nm_lengkap'];
          $e = $_POST['level'];

          $sql = "UPDATE master_user SET nm_user='$b', nm_lengkap='$d',level='$e' WHERE kd_user='$id'";

              if ($conn->query($sql)) {
              
              header('location:user.php?status=okdit');
              
          }
      }



}
else{

  $id = $_GET['id'];

    $sqlKode = "select * from master_user where kd_user='$id'";

    $r = $conn->query($sqlKode)->fetch();

}

  




include_once 'header.php';

                
                
?>

<div class="col col-sm-12">

<center><h2><strong>Lihat User</strong></h2></center>
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
                                                    <td><?php echo $r['nm_user']?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Nama Lengkap</td>
                                                    <td><?php echo $r['nm_lengkap']?></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Password</td>
                                                    <td>***</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Level</td>
                                                    <td> <?php echo  $r['level']?>
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

