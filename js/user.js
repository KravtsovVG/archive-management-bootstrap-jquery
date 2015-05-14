(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		
		// deklarasikan variabel
		var id_user = 0;
		var main = "api/user/user.data.php";
		var tree = "view/tree/tree.php";
		
		// tampilkan data user dari berkas user.data.php 
		// ke dalam <div id="data-user"></div>
		$("#data-tree").load(tree);
		$("#data-user").load(main);
		
		// ketika tombol ubah/tambah di tekan
		$('.ubah, .tambah').live("click", function(){
			
			var url = "api/user/user.form.php";
			// ambil nilai id dari tombol ubah
			id_user = this.id;
			
			if(id_user != 0) {
				// ubah judul modal dialog
				$("#myModalLabel").html("Ubah Data User");
			} else { 
				$("#myModalLabel").html("Tambah User");
			}

			$.post(url, {id: id_user} ,function(data) {
				// tampilkan user.form.php ke dalam <div class="modal-body"></div>
				$(".modal-body").html(data).show();
			});
		});
		
		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "api/user/user.input.php";
			// ambil nilai id dari tombol hapus
			id_user = this.id;
			
			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin mengghapus data ini?");
			
			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas user.input.php
				$.post(url, {hapus: id_user} ,function() {
					// tampilkan data user yang sudah di perbaharui
					// ke dalam <div id="data-user"></div>
					$("#data-user").load(main);
					$("#data-tree").load(tree);
				});
			}
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-user").bind("click", function(event) {
			var url = "api/user/user.input.php";

			// mengambil nilai dari inputbox
			var v_nama = $('input:text[name=nama]').val();
			var v_username = $('input:text[name=username]').val();
			var v_password = $('input:password[name=password]').val();
			var v_id_group = $('select[name=id_group]').val();
			var v_status_aktif = $('select[name=status_aktif]').val();

			// mengirimkan data ke berkas user.input.php untuk di proses
			$.post(url, {nama: v_nama, username: v_username, password: v_password, id_group: v_id_group, status_aktif: v_status_aktif, id: id_user} ,function() {
				// tampilkan data user yang sudah di perbaharui
				// ke dalam <div id="data-user"></div>
				$("#data-user").load(main);
				$("#data-tree").load(tree);

				// sembunyikan modal dialog
				$('#dialog-user').modal('hide');
				
				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah User");
			});
		});
	});
}) (jQuery);
