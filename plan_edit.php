<?php
include_once('koneksi.php');



if (!empty($_POST['id'])) {

echo $id = $_POST['id'];
echo $avg =$_POST['avg'];
echo $max = $_POST['max'];

echo $sql ="UPDATE afi SET avg='$avg',max='$max' WHERE id='$id'";


		    if ($conn->query($sql)) {
		      
		      header('location:plan.php?status=ok');
		      
		  }
}
else{

	$id = $_GET['id'];
  $avg = $_GET['avg'];
  $max = $_GET['max'];
}



?>

<form  method="POST">
          <table class="table">
            <tr>
              <td><input readonly type="text" class="form-control" placeholder="masukan sku" name="id" value="<?php echo $id?>"></td>
            </tr>
            <tr>
              <td><input autofocus type="text" class="form-control" placeholder="masukan avg" name="avg" value="<?php echo $avg?>"></td>
            </tr>
            <tr>
              <td><input autofocus type="text" class="form-control" placeholder="masukan max" name="max" value="<?php echo $max?>"></td>
            </tr>
            <tr>
              <td><button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i>Simpan</button></td>
            </tr>
          </table>
          

      
        </form>