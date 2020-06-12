
<?php

include_once 'koneksi.php';
include_once 'phpqrcode/qrlib.php';
error_reporting(0);
?>



<?php
if (!empty($_GET['bar'])) {
 

  $bar = $_GET['bar'];
  $xml=simplexml_load_file($bar) or die("Error: Cannot create object");


// $xml   = simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA);

    $dataScan = json_decode(json_encode($xml), TRUE);

 }





$FM="FM";
$KD_JENIS_TRANSAKSI=$dataScan['kdJenisTransaksi'];
$FG_PENGGANTI=$dataScan['fgPengganti'];
$NOMOR_FAKTUR=$dataScan['nomorFaktur'];




$TANGGAL_FAKTUR=$dataScan['tanggalFaktur'];

$tgl = explode("/", $TANGGAL_FAKTUR);
$hari = $tgl[0];
$bulan = $tgl[1];
$tahun = $tgl[2];

$MASA_PAJAK=$bulan;
$TAHUN_PAJAK=$tahun;

$NPWP=$dataScan['npwpPenjual'];
$NAMA=$dataScan['namaPenjual'];
$ALAMAT_LENGKAP=$dataScan['alamatPenjual'];
$JUMLAH_DPP=$dataScan['jumlahDpp'];
$JUMLAH_PPN=$dataScan['jumlahPpn'];
$JUMLAH_PPNBM=$dataScan['jumlahPpnBm'];
$TANGGAL_FAKTUR_FIX = $tahun."-".$bulan."-".$hari;
$REFERENSI=$dataScan['referensi'];

?>






<div class="container">
  <?php

echo "<center><h3>FAKTUR PAJAK<h3></center>";
echo "<table class='table table-bordered table-hover'>";
echo "

<tr>
<td colspan='2'>
<strong>Kode dan Nomor Seri Faktur Pajak :</strong> ".$dataScan['kdJenisTransaksi'].$dataScan['fgPengganti']."."
.substr($dataScan['nomorFaktur'], 0,3)."-".substr($dataScan['nomorFaktur'], 3,2).".".substr($dataScan['nomorFaktur'], 5,10)."
<td>
</tr>

<tr>
<td colspan='2'>
<strong>Pengusaha Kena Pajak</strong>
<td>
</tr>

<tr>
<td colspan='2'>
    <strong>Nama    :</strong> ".$dataScan['namaPenjual']."<br/>
    <strong>Alamat  :</strong> ".$dataScan['alamatPenjual']."<br/>
    <strong>NPWP    :</strong> ".substr($dataScan['npwpPenjual'], 0,2).".".substr($dataScan['npwpPenjual'], 2,3).".".substr($dataScan['npwpPenjual'], 5,3).".".substr($dataScan['npwpPenjual'], 8,1)."-".substr($dataScan['npwpPenjual'], 9,3).".".substr($dataScan['npwpPenjual'], 12,3)."<br/>
<td>
</tr>";

if (isset($dataScan['detailTransaksi']['0']['nama'])) {
  for ($i=0; $i < count($dataScan['detailTransaksi']); $i++) { 
    echo "<tr><td>".$no=($i+1)."</td>
            <td>".$dataScan['detailTransaksi'][$i]['nama']."<br/>
            "."Rp. ".number_format($dataScan['detailTransaksi'][$i]['hargaSatuan'])." x ".$dataScan['detailTransaksi'][$i]['jumlahBarang']."</td>
            <td align='center'>".number_format($dataScan['detailTransaksi'][$i]['hargaTotal'],2)."</td>

        </tr>";

        $JUMLAH_HARGA_TOTAL += $dataScan['detailTransaksi'][$i]['hargaTotal'];
        $JUMLAH_DISKON_TOTAL += $dataScan['detailTransaksi'][$i]['diskon'];
  }
}
else
{
  echo "<tr><td>1</td>
          <td>".$dataScan['detailTransaksi']['nama']."<br/>
          "."Rp. ".number_format($dataScan['detailTransaksi']['hargaSatuan'])." x ".$dataScan['detailTransaksi']['jumlahBarang']."</td>
          <td align='center'>".number_format($dataScan['detailTransaksi']['hargaTotal'],2)."</td>

      </tr>";

      $JUMLAH_HARGA_TOTAL = $dataScan['detailTransaksi']['hargaTotal'];
      $JUMLAH_DISKON_TOTAL = $dataScan['detailTransaksi']['diskon'];

}

echo "<tr>
<td colspan='2'>
<strong>Pembelian Barang Kena Pajak / Penerima Jasa Kena Pajak</strong>
<td>
</tr>

<tr>
<td colspan='2'>
    <strong>Nama    :</strong> ".$dataScan['namaLawanTransaksi']."<br/>
    <strong>Alamat  :</strong> ".$dataScan['alamatLawanTransaksi']."<br/>
    <strong>NPWP    :</strong> ".substr($dataScan['npwpLawanTransaksi'], 0,2).".".substr($dataScan['npwpLawanTransaksi'], 2,3).".".substr($dataScan['npwpLawanTransaksi'], 5,3).".".substr($dataScan['npwpLawanTransaksi'], 8,1)."-".substr($dataScan['npwpLawanTransaksi'], 9,3).".".substr($dataScan['npwpLawanTransaksi'], 12,3)."<br/>
<td>
</tr>


<tr>
  <th>No</th>
  <th align='center'>Nama Barang Kena Pajak / Jasa Kena Pajak</th>
  <th align='center'>Harga Jual/Penggantian/Uang Muka/Termin</th>
</tr>
";

echo "<tr>
          <th colspan='2'>Harga Jual / Penggantian</th>
          <td align='center'>".number_format($JUMLAH_HARGA_TOTAL,2)."</td>
    </tr>";

    echo "<tr>
          <th colspan='2'>Dikurangi Potongan Harga</th>
          <td align='center'>0</td>
    </tr>";

        echo "<tr>
          <th colspan='2'>Dikurangi Uang Muka</th>
          <td align='center'>".number_format($JUMLAH_DISKON_TOTAL,2)."</td>
    </tr>";

    echo "<tr>
          <th colspan='2'>Dasar Pengenaan Pajak</th>
          <td align='center'>".number_format($JUMLAH_DPP,2)."</td>
    </tr>";
    echo "<tr>
          <th colspan='2'>PPN = 10% x Dasar Pengenaan Pajak</th>
          <td align='center'>".number_format($JUMLAH_PPN,2)."</td>
    </tr>";
  echo "<tr>
          <th colspan='2'>Total PPnBM</th>
          <td align='center'>".number_format($JUMLAH_PPNBM,2)."</td>
    </tr>";



switch ($bulan) {
    case "01":
        $nama_bulan = "Januari";
        break;
    case "02":
        $nama_bulan = "Februari";
        break;
    case "03":
        $nama_bulan = "Maret";
        break;
    case "04":
        $nama_bulan = "April";
        break;
    case "05":
        $nama_bulan = "Mei";
        break;
    case "06":
        $nama_bulan = "Juni";
        break;
    case "07":
        $nama_bulan = "Juli";
        break;
     case "08":
        $nama_bulan = "Agustus";
        break;
    case "09":
        $nama_bulan = "September";
        break;   
    case "10":
        $nama_bulan = "Oktober";
        break;       
    case "11":
        $nama_bulan = "November";
        break;       
    case "12":
        $nama_bulan = "Desember";
        break;                                                               
    default:
        $nama_bulan = "error";
}



echo "</table>
<em>Sesuai dengan ketentuan yang berlaku, Direktorat Jendral Pajak mengatur bahwa Faktur Pajak ini telah ditandatangani secara elektronik sehingga tidak diperlukan tanda tangan basah pada Faktur Pajak ini.</em><br>

<strong>Tanggal Faktur Pajak :</strong> ".$hari." ".$nama_bulan." ".$tahun."";
echo "<hr>";

$isi_teks = $bar;
$namafile = "coba.png";
$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
$padding = 0;
 
$qr = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
 
$path = $tempdir.$namafile;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

  echo '<img width="100" height="100" src="'.$base64.'" />';
    echo " REF : ".$REFERENSI;                    
                
?>
</div>
