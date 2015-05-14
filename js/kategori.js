(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		
		// deklarasikan variabel
		var id_category = 0;
		var main = "api/kategori/kategori.data.php";
		var tree = "view/tree/tree.php";
		
		// tampilkan data kategori dari berkas kategori.data.php 
		// ke dalam <div id="data-category"></div>
		$("#data-tree").load(tree);
		$("#data-category").load(main);
		
		// ketika tombol ubah/tambah di tekan
		$('.ubah, .tambah').live("click", function(){
			
			var url = "api/kategori/kategori.form.php";
			// ambil nilai id dari tombol ubah
			id_category = this.id;
			
			if(id_category != 0) {
				// ubah judul modal dialog
				$("#myModalLabel").html("Ubah Data Kategori");
			} else { 
				$("#myModalLabel").html("Tambah Kategori");
			}

			$.post(url, {id: id_category} ,function(data) {
				// tampilkan kategori.form.php ke dalam <div class="modal-body"></div>
				$(".modal-body").html(data).show();
			});
		});
		
		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "api/kategori/kategori.input.php";
			// ambil nilai id dari tombol hapus
			id_category = this.id;
			
			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin mengghapus data ini?");
			
			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas kategori.input.php
				$.post(url, {hapus: id_category} ,function() {
					// tampilkan data kategori yang sudah di perbaharui
					// ke dalam <div id="data-category"></div>
					$("#data-category").load(main);
					$("#data-tree").load(tree);
				});
			}
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-category").bind("click", function(event) {
			var url = "api/kategori/kategori.input.php";

			// mengambil nilai dari inputbox
			var v_nama_category = $('input:text[name=nama_category]').val();
			var v_datetime = $('input:text[name=datetime]').val();
			var v_created_by = $('input:text[name=created_by]').val();

			// mengirimkan data ke berkas kategori.input.php untuk di proses
			$.post(url, {nama_category: v_nama_category, datetime: v_datetime, created_by: v_created_by, id: id_category} ,function() {
				// tampilkan data kategori yang sudah di perbaharui
				// ke dalam <div id="data-category"></div>
				$("#data-category").load(main);
				$("#data-tree").load(tree);

				// sembunyikan modal dialog
				$('#dialog-category').modal('hide');
				
				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah kategori");
			});
		});
	});
}) (jQuery);
