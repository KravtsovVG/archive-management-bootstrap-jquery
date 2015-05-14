<?php require_once 'inc/conf.php';  ?>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.autocomplete.min.js"></script>

				<script type="text/javascript">

					$(function(){
					  var judul_dokumen = [

						<?php
						if(!$query = mysql_query("SELECT DISTINCT nama_doc FROM document")){
							die(mysql_error());
						};
						while($data = mysql_fetch_array($query)){
						?>

							{ value: '<?php echo $data['nama_doc']; ?>' },

						<?php 
						};
						?>
					  ];
					  $('#autocomplete_judul').autocomplete({
					    lookup: judul_dokumen
					  });
					});

				</script>

<?php
	if(isset($_GET['file'])){
		$id_par_par = $_GET['param'];
		?>
		<div class="control-group">
			<label class="control-label" for="judul_dokumen">Kategori</label>
			<div class="controls">
				<?php
				if(!$katquery = mysql_query("SELECT * FROM category c NATURAL JOIN master_data md WHERE md.id=" . $id_par_par)){
					die(mysql_error());
				};
				$katdata = mysql_fetch_array($katquery);
					echo "<input type='text' class='input-xlarge' readonly='true' value='" . $katdata['nama_category'] . "'>";
					echo "<input type='hidden' class='input-xlarge' id='kategori' name='kategori' value='" . $katdata['id_category'] . "'>";
				?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="judul_dokumen">Subkategori</label>
			<div class="controls">
				<?php
				if(!$query = mysql_query("SELECT * FROM category c NATURAL JOIN master_data md WHERE md.id=" . $id_par_par)){
					die(mysql_error());
				};
				$data = mysql_fetch_array($query);
					echo "<input type='text' class='input-xlarge' readonly='true' value='" . $data['subkategori'] . "'>";
					echo "<input type='hidden' class='input-xlarge' id='subkategori' name='subkategori' value='" . $data['id'] . "'>";
				?>
			</div>
		</div>
		<?php
	};
?>
	<div class="control-group">
		<label class="control-label" for="judul_dokumen">Judul</label>
		<div class="controls">
			<input type="text" id="autocomplete_judul" class="input-xlarge" name="judul_dokumen">
		</div>
	</div>
	<hr />
	<div class="control-group">
		<label class="control-label" for="nama_dokumen">Nama Dokumen</label>
		<div class="controls">
			<input type="text" id="nama_dokumen" class="input-xlarge" name="nama_dokumen">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="deskripsi_dokumen">Deskripsi Dokumen</label>
		<div class="controls">
			<input type="text" id="deskripsi_dokumen" class="input-xlarge" name="deskripsi_dokumen">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="lokasi_fisik">Lokasi Fisik</label>
		<div class="controls">
			<input type="text" id="lokasi_fisik" class="input-xlarge" name="lokasi_fisik">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="dokumen_file">File</label>
		<div class="controls">
			<input type="file" id="dokumen_file" class="input-xlarge" name="dokumen_file">
		</div>
	</div>
