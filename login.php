
<!-- urutan bootstrap javascript harus jquery dulu baru javascript bootstrap-->
<?php include 'koneksi.php'; ?>
<div class="container">
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<style>
body { 
  background: url('images/spm.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.panel-default {
opacity: 0.9;
margin-top:150px;

}
.form-group.last { margin-bottom:0px; }


  
  .paraA
  {
    cursor: pointer;
    box-shadow: 2px 2px 0px black;
  }
  .paraB
  {
    cursor: pointer;
    box-shadow: 2px 2px 0px black;
  }
  .paraC
  {
    cursor: pointer;
    box-shadow: 2px 2px 0px black;
  }


  .grpA-d
  {
    border: 1px solid black;
        margin: 5px;
  }

  @media (max-width: 1500px) {
    #kop 
        {
            width: 50px; height: 50px; /* Hide the carousel text when the screen is less than 600 pixels wide */
        }
     }


</style>
<?php
      if(!empty($_GET['status']) && $_GET['status'] ='bad')
                {
                  echo '<script>sweetAlert("Maaf...", "Username dan Password Salah!", "error");</script>';
                  
                }
                
                
  ?> 
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
          <!--          <strong>AZERAF STORE</strong> -->
          <img src="images/brand.png" width="150" height="70"><h2>SCAN FAKTUR PAJAK</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form"  action="validation.php" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">
                            Username</label>
                        <div class="col-sm-9">
                       <input autofocus id="inputEmail3" name="nm_user" class="form-control" data-toggle="tooltip" title="enter your username" type="text" placeholder="enter your username">
                       
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">
                            Password</label>
                        <div class="col-sm-9">
                         <input id="inputPassword3" name="pass" class="form-control" data-toggle="tooltip"  title="enter your password" type="password" placeholder="enter your password">

                           
                        </div>
                    </div>
                    
                    <div class="form-group last">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <u>S</u>ign in</button>
                                 <button type="reset" class="btn btn-default btn-sm">
                                <u>R</u>eset</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="panel-footer">
                <ul>
                  <li><i>Username dan Password Case Sensitive</i></li>
                </ul>
                <hr>
                 Scan Faktur Pajak 2018 &copy; by <strong>Fachreza Maulana</strong>
                </div>
            </div>
        </div>
    </div>
</div>
