<?php
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}

include_once 'koneksi.php';
include_once 'header.php';


    
                
                
                
?>

<div class="col col-sm-12" style="overflow: ">
<div class="col col-sm-5">  </div>
  <div class="col col-sm-12">
    <h2>DATA PERUSAHAAN</h2>
  </div>
                   
<hr>
   <table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
                <thead>
                <tr class="bg bg-primary" style="background-color:  ">
                  <th width="3%">No.</th>
                  <th>NPWP</th>
                  <th>Nama Perusahaan</th>
                  <th>Telepon</th>
                  <th>Fax</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
                 $no=1;
                  $sql =$conn->query("select * from kantor");
                  
                  while($r = $sql->fetch()){
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r['npwp']; ?></td>
                <td><?php echo $r['nama']; ?></td>
                <td><?php echo $r['telp']; ?></td>
                <td><?php echo $r['fax']; ?></td>
                <td><?php echo $r['alamat']; ?></td>
                <td class="ctr">
                  <div class="btn-group">

                    <a href="kantor_lihat.php?id=<?php echo  $r['npwp']; ?>" data-toggle="tooltip" data-placement="left" title="Lihat" class="btn btn-primary">
                    <i class="fa fa-search"> </i></a>&nbsp;

                     <a href="kantor_edit.php?id=<?php echo  $r['npwp']; ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success">
                    <i class="fa fa-pencil"> </i></a>&nbsp;


              



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
