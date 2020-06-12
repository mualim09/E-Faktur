<?php
 session_start();
if (empty($_SESSION['nm_user'])) {
    
     header("location:login.php");
// 
}

include_once 'koneksi.php';

include_once 'header.php';


      if(!empty($_GET['status']) && $_GET['status'] =='ok')
                {
                  echo '<script>sweetAlert("Berhasil..", "Data berhasil di simpan !", "success");</script>';
                  
                }
                


                $serverName = "central";  
  
/* Connect using Windows Authentication. */  
try  
{  
$conn2 = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}

    
  $no=1;
  $now = '2018-06-30';
  $sql2 ="select * from WHOpnameMs where initDate >= '$now'";
  $hasil2 = $conn2->query($sql2);

  $sql3 ="select * from dbo.SMSKUdt WHere segLevel='3'";
  $hasil3 = $conn2->query($sql3);
  $sql4 ="select WrhsCode,WrhsName from SMWrhs";
  $hasil4 = $conn2->query($sql4);
                
?>

<div class="col col-sm-12">
<form action="../sc/scan_dt.php">
  <table class="table table-striped">
    <tr>
        <td>
          Division/Category
        </td>
        <td></td>      
    </tr>
    <tr>
        <td colspan="2">
          <div style="height: 100px;overflow: auto;">
            <?php
$no=0;
  while ($r3 = $hasil3->fetch()) {
   

          ?>
                    <label><input type="checkbox" name="cat[]" value="<?php echo $r3['SegCode']; ?>"><?php echo $r3['SegCode']." - ".$r3['SegDesc']; ?></label></br>

                    <?php
$no++;
}

                    ?>

          </div>
          
       
        </td>
      </tr>
      <tr>
        <td>
          SK Number
        </td>
        <td>
          <select name="sk" class="form-control" >
            
        
          <?php

  while ($r2 = $hasil2->fetch()) {
   

          ?>
                    <option><?php echo $r2['OpnameNmbr']; ?></option>

                    <?php
$no++;
}

                    ?>
          </select>
        </td>
      </tr>
       <tr>
        <td>
          Lokasi SO
        </td>
        <td>
           <select class="form-control" name="posi">
                            <?php
$no=0;

  while ($r4 = $hasil4->fetch()) {
   

          ?>
                   <option value="<?php  echo $r4['WrhsCode'] ?>"><?php  echo $r4['WrhsCode']." - ".$r4['WrhsName'] ?></option>

                    <?php
$no++;
}

                    ?>
           </select>
        </td>
      </tr>
      <tr>
        <td>
          Opname Number
        </td>
        <td>
           <input name="ket" class="form-control" value="" type="text" placeholder="masukan opname number">
        </td>
      </tr>
       <tr>
        <td>
          Tanggal
        </td>
        <td>
           <div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input class="form-control tgl"  name="tgl" value="<?php echo !empty($_GET['awal'])?$_GET['awal']:date('Y-m-d');?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                          </div>
        </td>
      </tr>
       <tr>
        <td>
          Opname By
        </td>
        <td>
           <input required name="upd" class="form-control" value="<?php //echo $_SESSION['nm_user']?>" type="text"  >
        </td>
      </tr>
      <tr>
        <td></td>
        <td align="right">
            <button onClick="return confirm('Apakah Anda yakin, akan Melanjutkan ?');" type="submit" class="btn btn-primary col-lg-12"><i class="fa fa-arrow-right"></i> Next</button>
        </td>
      </tr>

      
  </table>
</form>
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