<?php
session_start();
if (empty($_SESSION['nm_user'])) {
  
  header("location:login.php");
}

include_once 'koneksi.php';
include_once 'header.php';
// include_once 'grafik2.php';


?>


<div class="container-fluid">
        
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Data User Login</div>
            <div class="panel-body">
            <table class="table table striped">
            <tr>
                    <td>Nama Lengkap</td>
                    <td><h2>
                      <?php
                          echo  $_SESSION['nm_lengkap'];
                    ?></h2>
                    </td>
                </tr>
                <tr>
                    <td>Tipe User</td>
                    <td><h5>
                      <?php
                          echo  $_SESSION['level'];
                    ?></h5>
                    </td>
                </tr>
                 <tr>
                    <td>Login Time</td>
                    <td>
                      <?php
                          echo $time_login = $_SESSION['time'];
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Your IP Address</td>
                    <td>
                      <?php
                      echo $_SERVER['REMOTE_ADDR'];

                      ?>

                      </td>
                </tr>
                <tr>
                    <td>Your Browser</td>
                    <td><?php
                          echo $bro =  substr($_SERVER['HTTP_USER_AGENT'],0,7)." ".substr($_SERVER['HTTP_USER_AGENT'],-13);

                    ?></td>
                </tr>
                <tr>
                    <td>Your Oprating System</td>
                    <td><?php

                           echo $bro =  substr($_SERVER['HTTP_USER_AGENT'],11,34);
                    ?>  </td>
                </tr>

              <tr>
                    <td><img src="images/time.png" width="30" height="30"></td>
                    <td>
                    <span id="waktu"> <?php require_once 'tgl.php';  ?></span>
                  
                    </td>
                </tr>
                  <tr>
                    <td><img src="images/date.png" width="30" height="30"></td>
                    <td>
                     
                      <?php 
                        if (date('N')==7) {
                           $hari = "Minggu";
                        }
                        else if (date('N')==1) {
                           $hari = "Senin";
                        }
                       else if (date('N')==2) {
                           $hari = "Selasa";
                        }
                         else if (date('N')==3) {
                           $hari = "Rabu";
                        }
                         else if (date('N')==4) {
                           $hari = "Kamis";
                        }
                         else if (date('N')==5) {
                           $hari = "Jumat";
                        }
                         else if (date('N')==6) {
                           $hari = "Sabtu";
                        }

                     echo  $hari.' ,'.Indonesia2Tgl(date('Y-m-d')); ?>
                    </td>
                </tr>
              </table>



            </div>
        </div>
      </div>

   <!--     <div class="col-md-8">
        <div class="panel panel-primary">
          <div class="panel-heading">Grafik Scan Faktur Pajak Berdasarkan Tanggal Scan</div>
            <div class="panel-body">
              <div id ="mygraph"></div>
            </div>
        </div>
      </div>
  
   -->    


</div>



<?php include_once 'footer.php'; ?>