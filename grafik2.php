
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
	<script>
		var chart1; 
		$(document).ready(function() {
			  chart1 = new Highcharts.Chart({
				 chart: {
					renderTo: 'mygraph',
					type: 'column'
				 },   
				 title: {
					text: 'Grafik Faktur Pajak Berdasarkan Tanggal Scan '
				 },
				 xAxis: {
					categories: ['Tanggal Scan']
				 },
				 yAxis: {
					title: {
					   text: 'Jumlah Faktur'
					}
				 },
					  series:             
					[
						<?php 
						include_once 'koneksi.php';
						$now = date('Y-m-d');
						$sql   = "SELECT UPD, COUNT(NOMOR_FAKTUR) AS jml FROM pajak WHERE UPD BETWEEN (SELECT DATE_SUB(\"2018-08-21\", INTERVAL 1 WEEK)) AND '$now' GROUP BY UPD
";
						$query = $conn->query($sql);
						while( $r = $query->fetch())
						{                  
							           $UPD= explode("-",$r['UPD']);
							           $tgl_fix = $UPD[2]."/".$UPD[1]."/".$UPD[0];
						?>
							{
							  name: '<?php echo $tgl_fix ?>',
							  data: [<?php echo $r['jml']; ?>]
							},
							<?php 
						} 	?>
						]
			  });
		   });	
	</script>



<!--- Bagian Judul-->	

