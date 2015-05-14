<?php require_once '../../inc/conf.php'; session_start(); ?>

<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th style="width:20px">#</th>
		<th style="width:120px">Nama User</th>
		<th style="width:120px">Username</th>
		<th style="width:200px">Login Terakhir</th>
		<th style="width:120px">ID Grup</th>
		<th style="width:120px">Nama Grup</th>
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
	$pencarian = @$_SESSION['cari'];
	if(@$_SESSION['cari']){
		if(!$query = mysql_query("SELECT * FROM user WHERE nama LIKE '%$pencarian%' || username LIKE '%$pencarian%'")){
			die(mysql_error());
		};
		unset($_SESSION['cari']);
	}
	else{	
		if(!$query = mysql_query("SELECT * FROM user WHERE id_group != '2' && status_delete != 'Y'")){
			die(mysql_error());
		};
		unset($_SESSION['cari']);
	}
	if(mysql_num_rows($query)== 0){
		?>
		<tr>
			<td colspan="7">Tidak ada data yang cocok, <a href="?user=true">kembali</a></td>
		</tr>
		<?php
	}
	else{
		while($data = mysql_fetch_array($query)){
		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $data['nama'] ?></td>
			<td><?php echo $data['username'] ?></td>
			<td><?php echo $data['last_login'] ?></td>
			<td><?php echo $data['id_group'] ?></td>
			<td>
				<?php
				if(!$querygroup = mysql_query("SELECT * FROM user_group WHERE id_group=".$data['id_group'])){
					die(mysql_error());
				};
				while($datagroup = mysql_fetch_array($querygroup)){
					echo $datagroup['nama_group'];
				}
				?>
			</td>
			<?php
			if(substr($_SESSION['admin'], 0, 1) != 3 ){
				?>
				<td>
					<a href="#dialog-user" id="<?php echo $data['id_user'] ?>" class="ubah" data-toggle="modal">
						<i class="icon-pencil"></i>
					</a>
					<a href="#" id="<?php echo $data['id_user'] ?>" class="hapus">
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
	}
	?>
</tbody>
</table>
<?php
	if($pencarian){
		?>
		<a class="btn" href="?user=true">
			<i class="icon-arrow-left"></i> kembali ke daftar semua user
		</a>
		<?php
	}
	else{
		if(substr($_SESSION['admin'], 0, 1) != 3 ){
			?>
			<a href="#dialog-user" id="0" class="btn tambah" data-toggle="modal">
				<i class="icon-plus"></i> Tambah User
			</a>
			<?php
		};
	}
?>
