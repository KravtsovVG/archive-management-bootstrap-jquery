<?php require_once '../../inc/conf.php'; session_start(); ?>

<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th style="width:20px">#</th>
		<th style="width:220px">Nama Subkategori</th>
		<th style="width:220px">Kategori</th>
		<th style="width:120px">Update</th>
		<th style="width:220px">Diupdate Oleh</th>
		<?php
			if(substr($_SESSION['admin'], 0, 1) != 3 ){
				?>
				<th style="width:40px">Opsi</th>
				<?php
			}
		?>
	</tr>
</thead>
<tbody>
	<?php
	$i = 1;
	if(!$query = mysql_query("SELECT * FROM master_data ORDER BY id_category ASC")){
		die(mysql_error());
	};
	while($data = mysql_fetch_array($query)){
		if(!$kategori = mysql_query("SELECT nama_category FROM category WHERE id_category=".$data['id_category'])){
			die(mysql_error());
		};
		$nama_kategori = mysql_fetch_array($kategori);
	?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $data['subkategori'] ?></td>
		<td><?php echo $nama_kategori['nama_category'] ?></td>
		<td><?php echo $data['last_update'] ?></td>
		<td><?php echo $data['updated_by'] ?></td>
		<?php
		if(substr($_SESSION['admin'], 0, 1) != 3 ){
			?>
			<td>
				<a href="#dialog-subkategori" id="<?php echo $data['id'] ?>" class="ubah" data-toggle="modal">
					<i class="icon-pencil"></i>
				</a>
				<a href="#" id="<?php echo $data['id'] ?>" class="hapus">
					<i class="icon-trash"></i>
				</a>
			</td>
			<?php
		}
		?>
	</tr>
	<?php
		$i++;
	}
	?>
</tbody>
</table>

