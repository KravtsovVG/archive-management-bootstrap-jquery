<?php
require_once 'inc/conf.php'; 
require_once 'api/fungsi.php'; 
?>
<h3>Terakhir Diunggah</h3>
<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th style="width:20px">#</th>
		<th style="width:120px">Judul</th>
		<th style="width:120px">Nama Dokumen</th>
		<th style="width:220px" colspan="2">Nama File*</th>
		<th style="width:50px">Type</th>
		<th style="width:220px">Deskripsi</th>
		<th style="width:120px">Lokasi Fisik</th>
	</tr>
</thead>
<tbody>
	<?php
	if(!$query = mysql_query("SELECT * FROM document_detail dd NATURAL JOIN document d ORDER BY id_doc_detail DESC LIMIT 10")){
		die(mysql_error());
	};
	$i = 1;
	while($detailfile = mysql_fetch_array($query)){
	?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $detailfile['nama_doc'] ?></td>
		<td><?php echo $detailfile['nama_doc_detail'] ?></td>
		<td><?php echo substr($detailfile['file'], 0, -4) ?></td>
			<td style="text-align:center; background: #f5f5f5;">
				<form action="" method="POST">
					<input type="hidden" name="download" value="<?php echo $detailfile['id_doc_detail']; ?>">
					<input type="hidden" name="file_name" value="<?php echo $db_fungsi->root() . "uploads/" . $detailfile['file'] ?>">
					<a onclick="$(this).closest('form').submit();" href="#"><i class="icon-download-alt"></i></a>
				</form>
			</td>
		<td><?php echo substr($detailfile['file'], -4) ?></td>
		<td><?php echo $detailfile['deskripsi'] ?></td>
		<td><?php echo $detailfile['lokasi_fis'] ?></td>
	</tr>
	<?php
		$i++;
	}
	?>
</tbody>
</table>
<?php 
	if(isset($_POST['download'])){
		$id = $_POST['download'];
		$file_name = $_POST['file_name'];
		$query = "INSERT INTO last_download (id_download, id_doc_detail) VALUES ('', '". $id ."')";
		$result = mysql_query($query);
			if($result){
		?>
				<script type="text/javascript">
					window.open("<?php echo $file_name ?>","_blank");
				</script>
		<?php
			};
	};
?>
