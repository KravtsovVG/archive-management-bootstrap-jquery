<?php require_once '../../inc/conf.php'; session_start(); ?>

<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th style="width:20px">#</th>
		<th style="width:120px">Nama Kategori</th>
		<th style="width:120px">Tanggal Dibuat</th>
		<th style="width:120px">Oleh</th>
		<th style="width:120px">Diupdate Oleh</th>
		<th style="width:120px">Sub Kategori</th>
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
	if(!$query = mysql_query("SELECT * FROM category")){
		die(mysql_error());
	};
	while($data = mysql_fetch_array($query)){
		if(!$subkategori = mysql_query("SELECT * FROM master_data WHERE id_category=".$data['id_category'])){
			die(mysql_error());
		};
		$total_subkategori = mysql_num_rows($subkategori);
	?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $data['nama_category'] ?></td>
		<td><?php echo $data['datetime'] ?></td>
		<td><?php echo $data['created_by'] ?></td>
		<td><?php echo $data['update_by'] . " -> " . $data['tgl_update'] ?></td>
		<td style="text-align: center;"><?php echo $total_subkategori ?></td>
		<?php
		if(substr($_SESSION['admin'], 0, 1) != 3 ){
			?>
			<td>
				<a href="#dialog-category" id="<?php echo $data['id_category'] ?>" class="ubah" data-toggle="modal">
					<i class="icon-pencil"></i>
				</a>
				<a href="#" id="<?php echo $data['id_category'] ?>" class="hapus">
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

