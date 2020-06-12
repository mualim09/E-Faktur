<?php
// session_start();
// if (empty($_SESSION['nm_user'])) {
    
//     header("location:login.php");
// }


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

    

  $sql2 ="select distinct lok from lokasi";
  $hasil2 = $conn->query($sql2);

  $sql3 ="select * from foto";
  $hasil3 = $conn->query($sql3);
                
?>

<div class="col col-sm-12">
    <form action="add_foto.php" enctype="multipart/form-data" method="POST">
  <table class="table table-striped">
    <tr>
        <td>
          FOTO LOKASI
        </td>
        <td></td>      
    </tr>
      <tr>
        <td>
          Pilih Lokasi
        </td>
        <td>
          <select name="lok" class="form-control select-eza" >
          <?php

  while ($r2 = $hasil2->fetch()) {
   

          ?>
                    <option><?php echo $r2['lok']; ?></option>

                    <?php
$no++;
}

                    ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          Foto
        </td>
        <td>
          <input type="file" name="fileToUpload" id="fileToUpload">
        </td>
      </tr>
       
        <td></td>
        <td align="right">
            <button onClick="return confirm('Apakah Anda yakin, akan Melanjutkan ?');" type="submit" class="btn btn-primary col-lg-12"><i class="fa fa-arrow-right"></i> OK</button>
        </td>
      </tr>

      
  </table>
</form>
</div>
<hr>
<div style="clear: both;"></div>
  <div style="overflow:auto;height: 400px">
<table class="display table table-striped table-hover table-bordered tabza text-justify" width="100%" cellspacing="0" >
      <thead>
       <tr>
         <th data-priority="1">Lokasi</th>
         <th>Foto</th>
     </thead>
     <tbody>

     <?php 
  $no=1;

  
  $hasil3 = $conn->query($sql3);
  while ($data = $hasil3->fetch()) {

   ?> 
  <tr>  
    <td><a href="lokasi.php?cari=<?php echo $data['lok']; ?>"><?php echo $data['lok']; ?></a></td>
    <td><a href="images/<?php echo $data['foto']; ?>"><img src="images/<?php echo $data['foto']; ?>" width="80" height="100"></a> <a class="btn btn-sm btn-danger" onClick="return confirm('Apakah Anda yakin, akan Hapus ini ?');" href="hapus_foto.php?lok=<?php echo $data['lok']; ?>&foto=<?php echo $data['foto']; ?>"><i class="fa fa-trash"> </i></a></td>


  </tr>
  <?php $no++;} ?>


     </tbody>
  </table>
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


   $('.select-eza').selectize({
    create: true,
    sortField: 'text',
    // onOptionAdd: function (value, $item) { 
    //       var link='... link ...' + value;
    //       load_modal_content (link, '... csrf ...');
    //       $('#modal').modal('show');
    //       $item.selectize.removeOption(value);
    //   },
});

   $('.tabza').DataTable({

      "scrollY":        "350px",
        "scrollCollapse": true,
        "searching": false,
        "paging":         false
   });
</script>