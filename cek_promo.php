<?php
//untuk filter promo
            $tgl = date('Y-m-d');
            $sqlpromo ="SELECT * FROM _promo WHERE id_barang='$a' and tgl2 <='$tgl'";
            $hasilpromo =$conn->query($sqlpromo);
            $rowpromo = $hasilpromo->fetch();
            $tipe = $rowpromo['tip'];

            //cek apakah tipe diskon persentage atau amount

            if ($tipe == "PERCENTAGE") { 
                  
                   $disc = $rowpromo['perc'];
                   $discA = $hrg*($disc/100);
            }
            else if ($tipe == "AMOUNT") {
                  
                  $discA = $rowpromo['amt'];
                    $disc = ($discA/$hrg)*100;
            }

?>