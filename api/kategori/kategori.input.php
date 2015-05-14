<?php
require_once '../../inc/conf.php';
session_start();

// proses menghapus data category
if(isset($_POST['hapus'])) {
	mysql_query("DELETE FROM category WHERE id_category=".$_POST['hapus']);

	// if(!$file = mysql_query("SELECT * FROM category WHERE id_category=".$_POST['hapus'])){
	// 	die(mysql_error());
	// };

	// $totalsub = mysql_num_rows($file);
	
	// for ($i=0; $i < $totalsub; $i++) { 
	// 	mysql_query("DELETE FROM master_data WHERE id_category=".$_POST['hapus']);
	// }
}
else {
	// deklarasikan variabel
	$id_category	  = $_POST['id'];
	$nama_category 	  = $_POST['nama_category'];
	$datetime		  = $_POST['datetime'];
	$created_by 	  = $_POST['created_by'];
	
	$username = substr($_SESSION['admin'], 2);
    	if(!$queryname = mysql_query("SELECT nama FROM user WHERE username ='".$username."'")){
        	die(mysql_error());
        };
        while($datanama = mysql_fetch_array($queryname)){
			$update_by = $datanama['nama'];
		}

	$tgl_update 	  = date("Y-m-d H:i:s");
	
	// proses tambah data category
	if($id_category == 0) {
		mysql_query("INSERT INTO category (id_category, nama_category, datetime, created_by, tgl_update, update_by) VALUES('','".$nama_category."','".$datetime."','".$created_by."','".$tgl_update."','".$update_by."')");
	// proses ubah data category
	} else {
		mysql_query("UPDATE category SET 
		nama_category = '$nama_category',
		datetime = '$datetime',
		created_by = '$created_by',
		tgl_update = '$tgl_update',
		update_by = '$update_by'
		WHERE id_category = '$id_category'
		");
	}
}
?>
