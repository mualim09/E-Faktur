<?php 
$host="localhost";
$db="efaktur";
$user="root";
$pass="";

$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





if (!empty($_GET['masa'])) {
	$masa = $_GET['masa'];
	$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
$sqlEdit1 = "UPDATE pajak SET MASA_PAJAK='$masa' WHERE UPD BETWEEN '$awal' and '$akhir'";
	$conn->query($sqlEdit1);
	


}
else{

$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
	
}


$awal = $_GET['awal'];
$akhir = $_GET['akhir'];

$sqlKode = "select * from kantor limit 1";
$r = $conn->query($sqlKode)->fetch();
$npwp = $r['npwp'];


$now = date('Y-m-d');


 header("Content-type: application/vnd.ms-excel");
 header("Content-disposition: filename=".$npwp."_".$now.".csv");
//sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(0);


$output = fopen('php://output', 'w+');


$headers = array('"FM"', '"KD_JENIS_TRANSAKSI"', '"FG_PENGGANTI"', '"NOMOR_FAKTUR"', '"MASA_PAJAK"','"TAHUN_PAJAK"','"TANGGAL_FAKTUR"','"NPWP"','"NAMA"','"ALAMAT_LENGKAP"','"JUMLAH_DPP"','"JUMLAH_PPN"','"JUMLAH_PPNBM"','"IS_CREDITABLE"');


fputcsv($fp,$headers,',','"');
fclose($fp);

// output the column headings





$sql = "select * from pajak where EXPORT='N' AND UPD between '$awal' and '$akhir'";
// fetch the data
$rows = $conn->query($sql);
echo $headers[0].",".$headers[1].",".$headers[2].",".$headers[3].",".$headers[4].",".$headers[5].",".$headers[6].",".$headers[7].",".$headers[8].",".$headers[9].",".$headers[10].",".$headers[11].",".$headers[12].",".$headers[13]."\n";

   while ($r = $rows->fetch(PDO::FETCH_ASSOC)) {
            $tgl = explode("-", $r['TANGGAL_FAKTUR']);

            $TGL_FIX = $tgl[2]."/".$tgl[1]."/".$tgl[0];

       echo "\"".$r['FM']."\"".","."\"".$r['KD_JENIS_TRANSAKSI']."\"".","."\"".$r['FG_PENGGANTI']."\"".","."\"".$r['NOMOR_FAKTUR']."\"".","."\"".$r['MASA_PAJAK']."\"".","."\"".$r['TAHUN_PAJAK']."\"".","."\"".$TGL_FIX."\"".","."\"".$r['NPWP']."\"".","."\"".$r['NAMA']."\"".","."\"".$r['ALAMAT_LENGKAP']."\"".","."\"".$r['JUMLAH_DPP']."\"".","."\"".$r['JUMLAH_PPN']."\"".","."\"".$r['JUMLAH_PPNBM']."\"".","."\"".$r['IS_CREDITABLE']."\""."\n";

 }

$sqlEdit2 = "UPDATE pajak SET EXPORT='Y' WHERE UPD BETWEEN '$awal' and '$akhir'";
$conn->query($sqlEdit2);

?>

