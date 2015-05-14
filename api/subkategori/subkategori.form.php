<?php
require_once '../../inc/conf.php';
session_start();

// tangkap variabel id_subkategori
$id_subkategori = $_POST['id'];

// query untuk menampilkan subkategori berdasarkan id_subkategori
if(!$query = mysql_query("SELECT * FROM master_data WHERE id =".$id_subkategori)){
	die(mysql_error());
};
$data = mysql_fetch_array($query);

// jika id_subkategori > 0 / form ubah data
if($id_subkategori > 0) { 
	$subkategori 		= $data['subkategori'];
	$id_category		= $data['id_category'];
	$last_update 		= date("Y-m-d H:i:s");
	$updated_by 		= $data['updated_by'];

//form tambah data
}
else {
	$subkategori 	="";
	$last_update 	= date("Y-m-d H:i:s");

	$username = substr($_SESSION['admin'], 2);
	if(!$queryname = mysql_query("SELECT nama FROM user WHERE username ='".$username."'")){
        		die(mysql_error());
      	 };
        	while($datanama = mysql_fetch_array($queryname)){
		$updated_by = $datanama['nama'];
	}
}

?>
<form class="form-horizontal" id="form-subkategori">
	<div class="control-group">
		<label class="control-label" for="subkategori">Nama Subkategori</label>
		<div class="controls">
			<input type="text" id="subkategori" class="input-xlarge" name="subkategori" value="<?php echo $subkategori ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="id_category">Kategori</label>
		<div class="controls">
			<select id="id_category" class="input-xlarge" name="id_category">
				<?php
				if($id_subkategori > 0) { 
					if(!$katav = mysql_query("SELECT id_category, nama_category FROM category WHERE id_category =".$id_category)){
			        			die(mysql_error());
			      	 	};
			        		$id_katav = mysql_fetch_array($katav);
					echo "<option value='".$id_katav['id_category']."'>-- ".$id_katav['nama_category']." --</option>";
				}
					if(!$kat = mysql_query("SELECT id_category, nama_category FROM category")){
				        		die(mysql_error());
				      	};
				        	while($id_kat = mysql_fetch_array($kat)){
						echo "<option value='".$id_kat['id_category']."'>".$id_kat['nama_category']."</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="last_update">Tanggal Update</label>
		<div class="controls">
			<input type="text" id="last_update" class="input-xlarge" name="last_update" value="<?php echo $last_update ?>" readonly="readonly">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="updated_by">Oleh</label>
		<div class="controls">
			<input type="text" id="updated_by" class="input-xlarge" name="updated_by" value="<?php echo $updated_by ?>" readonly="readonly">
		</div>
	</div>
</form>
