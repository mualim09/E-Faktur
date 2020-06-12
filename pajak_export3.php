<?php
set_time_limit(0);
session_start();
if (empty($_SESSION['nm_user'])) {
    
    header("location:login.php");
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".date('Y-m-d')."_fakturpajak.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(1);

$host="localhost";
$db="efaktur";
$user="root";
$pass="";

$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
$sql="select * from pajak where UPD between '$awal' and '$akhir'";

?>
<table border="1" width=100% >
    <thead>
       <tr>
        <th>No</th>
        <th>NAMA</th>
        <th>TANGGAL_SCAN</th>
         <th>FM</th>
         <th>NPWP</th>
         <th>NOMOR_FAKTUR</th>
         <th>KONTRABON</th>
         <th>TAHUN_MASA_FAKTUR</th>
          <th>TANGGAL_FAKTUR</th>
         <th>TAHUN_MASA_KONTRABON</th>
         <th>TANGGAL_KONTRABON</th>
         <th>STATUS MASA</th>
         <th>JUMLAH_DPP</th>
         <th>JUMLAH_PPN</th>

       </tr>
     </thead>
     <tbody>

     <?php 
  $no=1;


  
  $hasil = $conn->query($sql);
  while ($data = $hasil->fetch()) {
   
   $NOMOR_FAKTUR_FIX = $data['KD_JENIS_TRANSAKSI'].$data['FG_PENGGANTI']."."
.substr($data['NOMOR_FAKTUR'], 0,3)."-".substr($data['NOMOR_FAKTUR'], 3,2).".".substr($data['NOMOR_FAKTUR'], 5,10);
    $KONTRA = $conn2->query("select top 1 CMTTTDt.TTTNmbr,convert(varchar, TTTDate, 23) TTTDate,GrnNmbr,FPMasukan,convert(varchar, FPDate, 23) FPDate,TTTAmount, TTTAmountPmt from CMTTThd inner join CMTTTdt ON  CMTTTDt.TTTNmbr =  CMTTThd.TTTNmbr WHERE FPMasukan='$NOMOR_FAKTUR_FIX'")->fetch();




$hari_faktur = substr($data['TANGGAL_FAKTUR'], 8,2);
$hari_kontra = substr($KONTRA['TTTDate'], 8,2);

  $tahun_faktur = substr($data['TANGGAL_FAKTUR'], 2,2);
  $bulan_faktur = substr($data['TANGGAL_FAKTUR'], 5,2);
  
  $tahun_kontra = substr($KONTRA['TTTDate'], 2,2);
 $bulan_kontra = substr($KONTRA['TTTDate'], 5,2);

 $tgl_faktur = $tahun_faktur.$bulan_faktur;
 $tgl_kontra = $tahun_kontra.$bulan_kontra;

?>

  <tr>
    <td><?php echo $no; ?></td> 
        <td><?php echo $data['NAMA']; ?></td>
    <td class="success"><?php echo $data['UPD']; ?></td>
    <td><?php echo $data['FM']; ?></td>
    <td><?php echo substr($data['NPWP'], 0,2).".".substr($data['NPWP'], 2,3).".".substr($data['NPWP'], 5,3).".".substr($data['NPWP'], 8,1)."-".substr($data['NPWP'], 9,3).".".substr($data['NPWP'], 12,3) ?></td>
    <td><?php echo $NOMOR_FAKTUR_FIX ?></td>
    <td><?php echo $KONTRA['TTTNmbr']?></td>
    <td><?php echo "<strong>".$tgl_faktur."</strong>" ?></td>
     <td><?php echo $data['TANGGAL_FAKTUR'] ?></td>
    <td><?php echo "<strong>".$tgl_kontra."</strong>" ?></td>
     <td><?php echo $KONTRA['TTTDate'] ?></td>

    <td><?php 
    if (empty($KONTRA['TTTNmbr'])) {
      echo "-";
    }
    elseif ($tgl_faktur == $tgl_kontra) {
      echo "MS";
    }
    elseif ($tgl_faktur != $tgl_kontra) {
      $nomor = $bulan_kontra - $bulan_faktur;
      echo "MTS-".$nomor;
    }
    else{
      echo "-";
    }

    ?></td>
      <td><?php echo $data['JUMLAH_DPP']; ?></td>
    <td><?php echo $data['JUMLAH_PPN']; ?></td>
  </tr>
  <?php $no++;} ?>
     </tbody>
</table>