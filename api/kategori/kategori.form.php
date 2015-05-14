<?php
require_once '../../inc/conf.php';
session_start();

// tangkap variabel id_category
$id_category = $_POST['id'];

// query untuk menampilkan category berdasarkan id_category
if(!$query = mysql_query("SELECT * FROM category WHERE id_category=".$id_category)){
	die(mysql_error());
};
$data = mysql_fetch_array($query);

// jika id_category > 0 / form ubah data
if($id_category > 0) { 
	$nama_category = $data['nama_category'];
	$datetime = $data['datetime'];
	$created_by = $data['created_by'];

//form tambah data
}
else {
	$nama_category ="";
	$datetime = date("Y-m-d H:i:s");
	
	$username = substr($_SESSION['admin'], 2);
    	if(!$queryname = mysql_query("SELECT nama FROM user WHERE username ='".$username."'")){
        		die(mysql_error());
      	 };
        	while($datanama = mysql_fetch_array($queryname)){
		$created_by = $datanama['nama'];
	}
}

?>
<form class="form-horizontal" id="form-category">
	<div class="control-group">
		<label class="control-label" for="nama_category">Nama Kategori</label>
		<div class="controls">
			<input type="text" id="nama_category" class="input-xlarge" name="nama_category" value="<?php echo $nama_category ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="datetime">Tanggal Dibuat</label>
		<div class="controls">
			<input type="text" id="datetime" class="input-xlarge" name="datetime" value="<?php echo $datetime ?>" readonly="readonly">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="created_by">Oleh</label>
		<div class="controls">
			<input type="text" id="created_by" class="input-xlarge" name="created_by" value="<?php echo $created_by ?>" readonly="readonly">
		</div>
	</div>
</form>
