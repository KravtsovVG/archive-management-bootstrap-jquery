<?php
require_once '../../inc/conf.php';

// tangkap variabel id_user
$id_user = $_POST['id'];

// query untuk menampilkan user berdasarkan id_user
if(!$query = mysql_query("SELECT * FROM user WHERE id_user=".$id_user)){
	die(mysql_error());
};
$data = mysql_fetch_array($query);

// jika id_user > 0 / form ubah data
if($id_user > 0) { 
	$nama = $data['nama'];
	$username = $data['username'];
	$password = $data['password'];
	$id_group = $data['id_group'];
	$status_aktif = $data['status_aktif'];
	
	if($data['id_group']=="1") {
		$group = "Administrator";
	}
	elseif($data['id_group']=="3") {
		$group = "Public User";
	}

	if($data['status_aktif']=="Y") {
		$status = "Aktif";
	}
	else {
		$status = "Tidak Aktif";
	}

//form tambah data
}
else {
	$nama ="";
	$username ="";
	$password ="";
	$id_group ="";
	$status_aktif ="";
}

?>
<form class="form-horizontal" id="form-user">
	<div class="control-group">
		<label class="control-label" for="nama">Nama</label>
		<div class="controls">
			<input type="text" id="nama" class="input-xlarge" name="nama" value="<?php echo $nama ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="username">Username</label>
		<div class="controls">
			<input type="text" id="username" class="input-xlarge" name="username" value="<?php echo $username ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input type="password" id="password" class="input-xlarge" name="password" value="<?php echo $password ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="id_group">ID Group</label>
		<div class="controls">
			<select class="input-medium" name="id_group">
				<?php
				// tampilkan untuk form ubah user
				if($id_user > 0) { ?>
					<option value="<?php echo $id_group ?>">-- <?php echo $group ?> --</option>
				<?php } ?>
				<option value="1">Administrator</option>
				<option value="3">Public User</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="status_aktif">Status Aktif</label>
		<div class="controls">
			<select class="input-medium" name="status_aktif">
				<?php 
				// tampilkan untuk form ubah user
				if($id_user > 0) { ?>
					<option value="<?php echo $status_aktif ?>">-- <?php echo $status ?> --</option>
				<?php } ?>
				<option value="Y">Aktif</option>
				<option value="T">Tidak Aktif</option>
			</select>
		</div>
	</div>
</form>
