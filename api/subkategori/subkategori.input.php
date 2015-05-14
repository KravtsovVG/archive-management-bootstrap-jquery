<?php
require_once '../../inc/conf.php';

// proses menghapus data master_data
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM master_data WHERE id=".$_POST['hapus']); 
}
else {
	// deklarasikan variabel
	$id	 		  = $_POST['id'];
	$subkategori 	  	  = $_POST['subkategori'];
	$id_category 	  	  = $_POST['id_category'];
	$last_update 	  	  = $_POST['last_update'];
	$updated_by  		  = $_POST['updated_by'];
	
	// proses tambah data master_data
	if($id == 0) {
		mysql_query("INSERT INTO master_data (id, subkategori, id_category, last_update, updated_by) VALUES('','".$subkategori."','".$id_category."','".$last_update."','".$updated_by."')");
	// proses ubah data master_data
	} else {
		mysql_query("UPDATE master_data SET 
		subkategori = '$subkategori',
		id_category = '$id_category',
		last_update = '$last_update',
		updated_by = '$updated_by'
		WHERE id = '$id'
		");
	}
}
?>
