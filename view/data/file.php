<?php
 require_once 'inc/conf.php';  

$kategori	= $_GET['k'];
$subkategori	= $_GET['s'];
$param	= $_GET['param'];
?>
				<script type="text/javascript">

					$(function(){
					  var q = [

						<?php
						if(!$query = mysql_query("SELECT DISTINCT * FROM document_detail dd NATURAL JOIN document d")){
							die(mysql_error());
						};
						while($data = mysql_fetch_array($query)){
						?>

							{ value: '<?php echo $data['nama_doc_detail']; ?>' },
							{ value: '<?php echo $data['file']; ?>' },
							{ value: '<?php echo $data['deskripsi']; ?>' },
							{ value: '<?php echo $data['lokasi_fis']; ?>' },
							{ value: '<?php echo $data['nama_doc']; ?>' }, 

						<?php 
						};
						?>
					  ];
					  $('#autocomplete').autocomplete({
					    lookup: q
					  });
					});

				</script>

				<div class="container">
					<div class="row">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="main_">
							<tr>
								<td class="left_">
									<div id="data-tree"></div>
								</td>
								<td class="right_">
									<form class="form-search" id="custom-search-form" method="GET">
										<input type="hidden" name="pencarian" value="file">
										<input type="hidden" name="k" value="<?php echo $kategori ?>">
										<input type="hidden" name="s" value="<?php echo $subkategori ?>">
										<input type="hidden" name="param" value="<?php echo $param ?>">
										<div class="input-prepend">
										    <i class="add-on">Nama Dokumen / Deskripsi / Lokasi Fisik</i>
										</div>
									    <div class="input-append input-prepend">
									    	<input type="text" placeholder="Cari" name="q" id="autocomplete">
									    </div>
									    <button type="submit" class="btn"><i class="icon-search"></i></button>
									</form>
								<hr>
									<h3><?php if(isset($_GET['pencarian'])){echo "Hasil Pencarian Arsip";}else{echo ucwords($kategori) . " &rarr; " . ucwords($subkategori );} ?></h3>

									<!-- tempat untuk menampilkan data file -->
									<?php require_once 'api/file/file.data.php' ; ?>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<?php require_once 'api/file/upload.modal.php'; ?>