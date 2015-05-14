<?php
require_once 'inc/conf.php'; 
require_once 'api/fungsi.php'; 
$id_sub = $_GET['param'];
?>

<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th style="width:20px">#</th>
		<th style="width:120px">Judul</th>
		<th style="width:120px">Nama Dokumen</th>
		<th style="width:220px" colspan="2">Nama File*</th>
		<th style="width:50px">Type</th>
		<?php if(!isset($_SESSION['cari'])){
			echo "<th style='width:220px'>Deskripsi</th>";
		}
		else{
			echo "<th style='width:220px'>Di</th>";	
		}
		?>
		<th style="width:120px">Lokasi Fisik</th>
		<?php
			if(substr($_SESSION['admin'], 0, 1) != 3 ){
				?>
				<th style="width:40px">Opsi</th>
				<?php
			};
		?>
	</tr>
</thead>
<tbody>
	<?php
	$i = 1;
	if(!$query = mysql_query("SELECT * FROM master_data WHERE id= " . $id_sub . " ORDER BY id ASC")){
		die(mysql_error());
	};
	while($data = mysql_fetch_array($query)){
		$pencarian = @$_SESSION['cari'];
		if(@$_SESSION['cari']){
			if(!$filedetail = mysql_query("SELECT * FROM document_detail dd NATURAL JOIN document d WHERE d.nama_doc LIKE '%$pencarian%' || dd.nama_doc_detail LIKE '%$pencarian%' || dd.file LIKE '%$pencarian%' || dd.deskripsi LIKE '%$pencarian%' || dd.lokasi_fis LIKE '%$pencarian%'")){
				die(mysql_error());
			};
			unset($_SESSION['cari']);
		}
		else{
			if(!$filedetail = mysql_query("SELECT * FROM document_detail dd NATURAL JOIN document d WHERE d.id_service_name=".$data['id']." ORDER BY  d.id_doc ASC")){
				die(mysql_error());
			};
			unset($_SESSION['cari']);
		}
		if(mysql_num_rows($filedetail)== 0){
			?>
			<tr>
				<td colspan="9">File masih kosong, mulailah <a href="#dialog-upload" id="0" class="upload" data-toggle="modal">mengunggah file</a></td>
			</tr>
			<?php
		}
		else{
			while($detailfile = mysql_fetch_array($filedetail)){
		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $detailfile['nama_doc'] ?></td>
			<td><?php echo $detailfile['nama_doc_detail'] ?></td>
			<td><?php echo substr($detailfile['file'], 0, -4) ?></td>
				<td style="text-align:center; background: #f5f5f5;"><a href="<?php echo $db_fungsi->root() . "uploads/" . $detailfile['file'] ?>"><i class="icon-download-alt"></i></a></td>
			<td><?php echo substr($detailfile['file'], -4) ?></td>
			<td>
				<?php
				if(!isset($_GET['pencarian'])){
					echo $detailfile['deskripsi'];
				}
				else{
					if(!$di = mysql_query("SELECT * FROM category c NATURAL JOIN master_data md WHERE md.id = '" . $detailfile['id_service_name'] . "'")){
						die(mysql_error());
					};
					while($didimana = mysql_fetch_array($di)){
						echo $didimana['nama_category'] . " &rarr; " . $didimana['subkategori'];
					}
				}
				?>
			</td>
			<td><?php echo $detailfile['lokasi_fis'] ?></td>
			<?php
			if(substr($_SESSION['admin'], 0, 1) != 3 ){
				?>
				<td>
					<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>&hapus=<?php echo $detailfile['id_doc_detail'] ?>&file=<?php echo $detailfile['file'] ?>&id_doc=<?php echo $detailfile['id_doc'] ?>" onClick = 'return confirmDelete();'>
						<i class="icon-trash"></i>
					</a>
				</td>
				<?php
			};
			?>
		</tr>
		<?php
			$i++;
			}
		}
	}
	?>
</tbody>
</table>
<?php
	if($pencarian){
		?>
		<a class="btn" href="javascript:history.back(-1)">
			<i class="icon-arrow-left"></i> kembali ke daftar semua arsip
		</a>
		<?php
	}
	else{
		?>
		<div class="input-prepend input-append">
			<a href="#dialog-upload" id="0" class="upload btn" data-toggle="modal">
				<i class="icon-plus"></i> Tambah File
			</a>
			<i class="add-on"> atau </i>
			<a href="?cetak=true&<?php echo "k=" . $_GET['k'] . "&s=" . $_GET['s'] . "&param=" . $_GET['param'] ?>" target="_blank" class="btn">
				<i class="icon-print"></i> Cetak
			</a>
		</div><br /><br />
		<small>* klik icon <i class="icon-download-alt"></i> untuk mengunduh file.</small>
		<?php
	} 
?>
<script type="text/javascript">
	function confirmDelete(){
		var agree = confirm("Anda yakin ingin menghapus dokumen ini?");
	 	if(agree == true){
	   		return true
		}
		else{
			return false;
		}
	}
</script>
<?php 
// aksi hapus file
if(isset($_GET['hapus'])) {
	//DELETE DATA
	$query = "delete from document_detail where id_doc_detail = '".$_GET['hapus']."'";
	$result = mysql_query($query);
	if (!$result)
		echo "failed";
	else {
		@unlink("uploads/".$_GET['file']);
		
		$query = "select count(id_doc_detail) as jumlah from document_detail where id_doc = '".$_GET['id_doc']."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		if ($row['jumlah'] == 0) {
			$query = "delete from document where id_doc = '".$_GET['id_doc']."'";
			$result = mysql_query($query);
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
};
?>