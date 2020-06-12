<?php
session_start();
include_once 'koneksi.php';

if (!empty($_POST['sku'])) {

//untuk filter barang berdasarkan sku atau barcode
		$a = $_POST['sku'];
		$sqlfilter ="SELECT * FROM barang WHERE sku ='$a'or bar='$a'";
		$hasilfilter =$conn->query($sqlfilter);
		$rowfilter = $hasilfilter->fetch();
		$id = $_POST['id'];
		$a = $rowfilter['sku'];

	  $hrg = $rowfilter['hrg']; //harga sebelum diskon

	
//untuk cek barang apakah sudah discan
		$sqlkode ="SELECT count(*) as jml FROM _pos_tmp WHERE id_barang ='$a'";
		$hasilkode =$conn->query($sqlkode);
		$rowkode = $hasilkode->fetch();
      	$jml = $rowkode['jml'];





	if ($jml > 0 ) { //kondisi jika barang sudah discan

		
		$sqlsku ="SELECT * FROM barang WHERE sku ='$a'";
		$hasilsku =$conn->query($sqlsku);
		$rowsku = $hasilsku->fetch();
		$b = $_POST['qty'];
		$c = $rowsku['hrg'];
		$ppn =0;

		if ($rowsku['ppn']=='Y') { //cek jika barang itu ppn

			$ppn = ($rowsku['hrg']*0.1);
			$hrg = $hrg+$ppn;
		}


		 
		 


		 $e = ($b*$c);


		  echo $sql ="UPDATE pos_tmp SET qty=(qty+$b) WHERE id_barang='$a'";
		  echo $sql2 ="UPDATE pos_tmp SET brt=(qty*hrg) WHERE id_barang='$a'";
		  echo $sql3 ="UPDATE pos_tmp SET ppn=(brt*0.1) WHERE id_barang='$a'";
		  echo $sql4 ="UPDATE pos_tmp SET discA=(brt*(disc/100)) WHERE id_barang='$a'";
		  echo $sql5 ="UPDATE pos_tmp SET tot=brt-discA WHERE id_barang='$a'";


		    

		  try {
			  		if ($conn->query($sql) && $conn->query($sql2) && $conn->query($sql3) && $conn->query($sql4) && $conn->query($sql5) ) {
			      
			      header('location:kasir.php');
			  }

		  	
		  } 

         catch (Exception $e) {

          // Note The Typecast To An Integer!

		    echo $err = $e->getMessage();
		    header('location:kasir.php?status=err&txt=Barang tidak ada!');
		          
        }

	 	
	 } 

	 else
	 { //kondisi jika barang belum pernah discan
	 	
		$sqlsku ="SELECT * FROM barang WHERE sku ='$a'";
		$hasilsku =$conn->query($sqlsku);
		$rowsku = $hasilsku->fetch();


		include_once 'cek_promo.php';

		 $b = $_POST['qty'];
		 $ppn =0;
		 
		
		 $c = $rowsku['uom'];

		
 $d = $rowsku['hrg'];
		  if ($rowsku['ppn']=='Y') { //cek jika barang itu ppn
		  	$d = $rowsku['hrg'] + ($rowsku['hrg']*0.1);
			$ppn = ($rowsku['hrg']*0.1);
		}



		 $brt = $b*$d;


		 

		 $upd = $_SESSION['nm_user'];
		 $discA = $discA*$b;
		 $e = ($b*$d)-$discA;


		 echo $sql ="INSERT INTO pos_tmp VALUES('$id','$a','$b','$c','$d','$brt','$disc','$discA','$ppn','$e','$upd')";

					try {

							if ($conn->query($sql)) {
							      
							      header('location:kasir.php');
							      
							  }
						
					} catch (Exception $e) {
						  echo $err = $e->getMessage();
							    header('location:kasir.php?status=err&txt=Barang tidak ada!');
						
					}
		    
	 }



}

?>