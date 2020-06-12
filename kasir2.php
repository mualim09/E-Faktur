<?php
// session_start();
// if (empty($_SESSION['nm_user'])) {
    
//     header("location:login.php");
// }


include_once 'koneksi.php';

include_once 'header.php';

  $sql2 ="select DISTINCT lok from lokasi";
  $hasil2 = $conn->query($sql2);
                
?>

<div class="col col-sm-12">
<form action="../sc/scan_dt2.php">
  <table class="table table-striped">
    <tr>
        <td>
          Pilih Lokasi
        </td>
        <td></td>      
    </tr>
    <tr>
        <td colspan="2">
                   <select class="form-control select-eza" name="lok">
                     <?php while ($r2 = $hasil2->fetch()) { ?>
                    <option><?php echo $r2['lok'] ?></option>

                    <?php } ?>
                   </select>
          
       
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

       $('.select-eza').selectize({
    sortField: 'text',
    // onOptionAdd: function (value, $item) { 
    //       var link='... link ...' + value;
    //       load_modal_content (link, '... csrf ...');
    //       $('#modal').modal('show');
    //       $item.selectize.removeOption(value);
    //   },
});
</script>