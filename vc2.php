<?php     date_default_timezone_set("Asia/Jakarta");


    //Include the barcode script
    
    include_once 'barcode.php';
    
    # Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function Indonesia3Tgl($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}

?>


<!DOCTYPE html>

<html lang="en-US">
  
  <head>
    
    <title>Barcode Generator</title>
    <style type="text/css">
      @media print {
      #ok {
         background: linear-gradient(to bottom, #ffffff 33%, #0066ff 100%) !important;
          -webkit-print-color-adjust: exact; 
      }}

    </style>
  </head>
  
<body>
  

<!-- div untuk kertas A4 landscape -->
<div style="width: 1060px;height: 100%;border: px solid black;padding:1%"> 




<?php

$awal = $_GET['awal'];
$akhir = $_GET['akhir'];

  for ($i=$awal; $i <= $akhir; $i++) { 

  ?>

<div id="ok"  style="display:inline-block;border:1px solid black;width:511px;height: 245px;padding: 5px;z-index: -1">
  
      <div style="border:px solid black;display:inline-block;width: 60%;">
          <img src="images/stb.png" width="160" height="40">
      </div>

       <div style="border:px solid black;display:inline-block;width: 30%">
          <?php
                         $kode = $_GET['kode'];
                         $angka = $i;

                         $kode = $kode.'-'.$angka;
                         $tgl = Indonesia3Tgl($_GET['tgl']);
                          $img      = code128BarCode($kode, 1);
              ob_start();
              imagepng($img);
              $output_img   = ob_get_clean();
                          echo '<img width="160" height="40" src="data:image/png;base64,' . base64_encode($output_img) . '" />'; 

                            ?>
      </div>
      <div style="border:px solid black;display:inline-block;width: 100%;height: 100PX;font-family:Edwardian Script ITC";>          
            <center><h1 style="font-size: 100px;margin-top: -10px">Rp. <?php echo number_format($_GET['hrg'])?></h1></center>
      </div>
      <div style="border:px solid black;display:inline-block;width: 60%;font-size: 7px; ">
        Term & Conditions:
          <ul>
            <li>This voucher is not redeemable for cash</li>
            <li>Valid only at Setiabudhi Supermarket</li>
          </ul>
      </div>

       <div style="border:px solid black;display:inline-block;width: 30%;font-size: 8px;text-align: justify;">
         <table>
           <tr>
             <td>No</td>
             <td>:</td>
             <td><?php echo $kode;?></td>
           </tr>
           <tr>
             <td>Expired</td>
             <td>:</td>
             <td><?php echo $tgl;?></td>
           </tr>
         </table>
      </div>
      <div style="border:1px dashed black;display:inline-block;width: 100%;height: 50PX">
          <center>
            SETIABUDHI SUPERMARKET
          </center>
          <center>Jl. Setiabudhi No. 42&46, Bandung. Phone (022) 203 5000</center>
      </div>
  
</div>


<?php
  }

?>







                                    
</div>
<!-- akhir div A4 landscape -->
</body>
  
</html>