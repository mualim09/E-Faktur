(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		
		// deklarasikan variabel
		var id = 0;
		
		$(".angka").keydown(function(e){
			var keyPressed;
			if (!e) var e = window.event;
			if (e.keyCode) keyPressed = e.keyCode;
			else if (e.which) keyPressed = e.which;
			var hasDecimalPoint = (($(this).val().split('.').length-1)>0);
			if ( keyPressed == 46 || keyPressed == 8 ||((keyPressed == 190||keyPressed == 110)&&(!hasDecimalPoint)) || keyPressed == 9 || keyPressed == 27 || keyPressed == 13 ||
					 // Allow: Ctrl+A
					(keyPressed == 65 && e.ctrlKey === true) ||
					 // Allow: home, end, left, right
					(keyPressed >= 35 && keyPressed <= 39)) {
						 // let it happen, don't do anything
						 return;
				}
				else {
					// Ensure that it is a number and stop the keypress
					if (e.shiftKey || (keyPressed < 48 || keyPressed > 57) && (keyPressed < 96 || keyPressed > 105 )) {
						e.preventDefault();
					}
				}

  		}); 


  			$("#harga2").keydown(function(e){
			var keyPressed;
			if (!e) var e = window.event;
			if (e.keyCode) keyPressed = e.keyCode;
			else if (e.which) keyPressed = e.which;
			var hasDecimalPoint = (($(this).val().split('.').length-1)>0);
			if ( keyPressed == 46 || keyPressed == 8 ||((keyPressed == 190||keyPressed == 110)&&(!hasDecimalPoint)) || keyPressed == 9 || keyPressed == 27 || keyPressed == 13 ||
					 // Allow: Ctrl+A
					(keyPressed == 65 && e.ctrlKey === true) ||
					 // Allow: home, end, left, right
					(keyPressed >= 35 && keyPressed <= 39)) {
						 // let it happen, don't do anything
						 return;
				}
				else {
					// Ensure that it is a number and stop the keypress
					if (e.shiftKey || (keyPressed < 48 || keyPressed > 57) && (keyPressed < 96 || keyPressed > 105 )) {
						e.preventDefault();
					}
				}

  		}); 
				
		// ketika tombol hapus ditekan
		$('.delete-customer').click(function(){
			var url = "delete-customer.php";
			// ambil nilai id dari tombol hapus
			id = this.title;
			
			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin mengghapus data ini?");
			
			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {id: id} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					//$("#data-mahasiswa").load(main);
					var domainName=window.location.hostname;
					window.location = "http://" + domainName + "/crud-lengkap/index.php"
				});
			}
		});
		


		/*$('ul.pagination li a').click(function() {
			$('ul.pagination li.active').removeClass("active");
			$(this).parent().addClass("active");
		});*/

	});//end of  document function
}) (jQuery);
