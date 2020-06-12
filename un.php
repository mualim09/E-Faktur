<!DOCTYPE html>
<html>
<body>
<?php
// session_start();
// if (empty($_SESSION['nm_user'])) {
    
//     header("location:login.php");
// }

error_reporting(0);
include_once 'koneksi.php';
include_once 'header.php';
include_once 'phpqrcode/qrlib.php';


                      
                
?>


      <table class="table table-striped">
      	<tr>
      		<td>Scan Fakur yang akan di UN-EXPORT</td>
      	</tr>
          <tr>
            <td>
             <input autofocus type="text" id="urlPajak" name="bar" placeholder="scan barcode faktur" class="form-control">
            </td>
           </tr>
        </table>


<script type="text/javascript">

$(document).ready(function(){
	
	$("#urlPajak").on('change',function(){

		var id = $(this).val();

			$.ajax({
				url:'load.php',
				type:'post',
				data : {id : id},
				success:function(data){
					$("#urlPajak").focus();
					$('#data').html(data);
					$("#urlPajak").val("");



				}

			})

	});
	
});
</script>

</head>
<body>

<div id="data"></div>

</body>
</html>
