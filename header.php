<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="images/brand.png" width="120" height="50"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-database"></i> Master Data <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <?php if($_SESSION['level']=="Admin"){?>
            <li role="separator" class="divider"></li>
            <li><a href="kantor.php"><i class="fa fa-building-o"></i> Perusahaan</a></li>
            <li><a href="user.php"><i class="fa fa-users"></i> User Manager</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="h_tran.php"><i class="fa fa-trash"></i> Hapus Transaksi</a></li>
          
          <?php }?>
          </ul>
        </li>

      


         


        <li class="dropdown">
          <a href="pajak.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-desktop"></i> Scan Faktur Pajak </a>
        </li>

          <li class="dropdown">
          <a href="pajak_export.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars "></i> List Scan Faktur </a>
        </li>

        <li class="dropdown">
          <a href="pajak_report.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-line-chart "></i> Analisa Faktur Pajak </a>
        </li>

<li class="dropdown">
          <a href="pajak_report2.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-calendar "></i> Cek Masa Tidak Sama</a>
        </li>

<li class="dropdown">
          <a href="un.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-refresh "></i> UN EXPORT</a>
        </li>


       

      </ul>
     
      
      <ul class="nav navbar-nav navbar-right">
       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Selamat datang <?php if (isset($_SESSION['nm_user'])) {echo $_SESSION['nm_user'];} ?></strong> ! <span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><img class="img img-circle" src="images/user.png" width="50" height="50"></li>
            <li><a href="user_set.php?id=<?php echo $_SESSION['kd']; ?>"><i class="fa fa-cog"></i> Setting</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Sign Out</a></li>


          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

</nav>
</div>
<!--     <div id="loading" class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-primary active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">45% Complete</span>
  </div>
</div> -->
<!-- <div id="box" style="display: visible;"> -->
<?php
  if(!empty($_GET['status']) && $_GET['status'] =='ok')
                {
                  echo '<script>sweetAlert("Berhasil..", "Data di tambah !", "success");</script>';
                  
                }
                
                else if(!empty($_GET['status']) && $_GET['status'] =='okdel')
                {
                  echo '<script>sweetAlert("Berhasil..", "Data di hapus !", "success");</script>';
                  
                }
                else if(!empty($_GET['status']) && $_GET['status'] =='okdit')
                {
                  echo '<script>sweetAlert("Berhasil..", "Data di edit !", "success");</script>';
                  
                }
                else if(!empty($_GET['status']) && $_GET['status'] =='err')
                {
                  $txt =$_GET['txt'];
                  echo '<script>sweetAlert("Gagal..", "'.$txt.'", "error");</script>';
                  
                }
                 else if(!empty($_GET['status']) && $_GET['status'] =='errk')
                {
                  $txt =$_GET['txt'];
                  echo '<script>sweetAlert("Gagal..", "'.$txt.'", "error");</script>';
                  
                }
?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Descripsi</h4>
      </div>
      <div class="modal-body">
        <form action="edit_des.php">
          <input autofocus type="text" class="form-control" placeholder="masukan kode TI - TO" name="id">
          <div class="input-group input-group-lg">
          

          <input autofocus type="text" class="form-control" placeholder="masukan kata deskripsi" name="ket">
          <span class="input-group-btn">
            <button class="btn btn-danger" type="submit"><i class="fa fa-pencil"></i></button>
          </span>
          </div>
        </form>
      </div>
      
    </div>

  </div>
</div>


<!-- Modal -->
<div id="myAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Rata2 dan Max</h4>
      </div>
      <div class="modal-body">
        <form action="plan_add.php">
          <table class="table">
            <tr>
              <td><input autofocus type="text" class="form-control" placeholder="masukan sku" name="id"></td>
            </tr>
            <tr>
              <td><input autofocus type="text" class="form-control" placeholder="masukan avg" name="avg"></td>
            </tr>
            <tr>
              <td><input autofocus type="text" class="form-control" placeholder="masukan max" name="max"></td>
            </tr>
            <tr>
              <td><button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i>Simpan</button></td>
            </tr>
          </table>
          

      
        </form>
      </div>
      
    </div>

  </div>
</div>
<script type="text/javascript">

    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        //language:  'ind',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
       // language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>