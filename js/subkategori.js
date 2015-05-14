(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		
		// deklarasikan variabel
		var id_subkategori = 0;
		var main = "api/subkategori/subkategori.data.php";
		var tree = "view/tree/tree.php";
		
		// tampilkan data subkategori dari berkas subkategori.data.php 
		// ke dalam <div id="data-subkategori"></div>
		$("#data-tree").load(tree);
		$("#data-subkategori").load(main);
		
		// ketika tombol ubah/tambah di tekan
		$('.ubah, .tambah').live("click", function(){
			
			var url = "api/subkategori/subkategori.form.php";
			// ambil nilai id dari tombol ubah
			id_subkategori = this.id;
			
			if(id_subkategori != 0) {
				// ubah judul modal dialog
				$("#myModalLabel").html("Ubah Data Subkategori");
			} else { 
				$("#myModalLabel").html("Tambah Subkategori");
			}

			$.post(url, {id: id_subkategori} ,function(data) {
				// tampilkan subkategori.form.php ke dalam <div class="modal-body"></div>
				$(".modal-body").html(data).show();
			});
		});
		
		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "api/subkategori/subkategori.input.php";
			// ambil nilai id dari tombol hapus
			id_subkategori = this.id;
			
			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin mengghapus data ini?");
			
			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas subkategori.input.php
				$.post(url, {hapus: id_subkategori} ,function() {
					// tampilkan data subkategori yang sudah di perbaharui
					// ke dalam <div id="data-subkategori"></div>
					$("#data-subkategori").load(main);
					$("#data-tree").load(tree);
				});
			}
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-subkategori").bind("click", function(event) {
			var url = "api/subkategori/subkategori.input.php";

			// mengambil nilai dari inputbox
			var v_subkategori = $('input:text[name=subkategori]').val();
			var v_id_category = $('select[name=id_category]').val();
			var v_last_update = $('input:text[name=last_update]').val();
			var v_updated_by = $('input:text[name=updated_by]').val();

			// mengirimkan data ke berkas subkategori.input.php untuk di proses
			$.post(url, {subkategori: v_subkategori, id_category: v_id_category, last_update: v_last_update, updated_by: v_updated_by, id: id_subkategori} ,function() {
				// tampilkan data subkategori yang sudah di perbaharui
				// ke dalam <div id="data-subkategori"></div>
				$("#data-subkategori").load(main);
				$("#data-tree").load(tree);

				// sembunyikan modal dialog
				$('#dialog-subkategori').modal('hide');
				
				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Subkategori");
			});
		});
	});
}) (jQuery);
