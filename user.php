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
    <a href="user_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a>
  </div>
  <div class="col col-sm-7">
    <h2>DATA USER</h2>
  </div>
                   
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
                <thead>
                <tr class="bg bg-primary" style="background-color:  ">
                  <th width="3%">No.</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Nama Lengkap</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
                 $no=1;
                  $sql =$conn->query("select * from master_user");
                  
                  while($r = $sql->fetch()){
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r['nm_user']; ?></td>
                <td><?php echo '***';// $r['pass']; ?></td>
                <td><?php echo $r['nm_lengkap']; ?></td>
                <td><?php echo $r['level']; ?></td>
                <td class="ctr">
                  <div class="btn-group">

                    <a href="user_lihat.php?id=<?php echo  $r['kd_user']; ?>" data-toggle="tooltip" data-placement="left" title="Lihat" class="btn btn-primary">
                    <i class="fa fa-search"> </i></a>&nbsp;

                     <a href="user_edit.php?id=<?php echo  $r['kd_user']; ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success">
                    <i class="fa fa-pencil"> </i></a>&nbsp;


                    <a onClick="return confirm('Apakah Anda yakin, akan Hapus ini ?');"  class="btn btn-danger" href="user_hapus.php?id=<?php echo  $r['kd_user']; ?>" data-toggle="tooltip" data-placement="right" title="Hapus" >
                    <i class="fa fa-trash"> </i></a>&nbsp;



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
