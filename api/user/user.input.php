<?php
require_once '../../inc/conf.php';

// proses menghapus data user
if(isset($_POST['hapus'])) {
	// mysql_query("DELETE FROM user WHERE id_user=".$_POST['hapus']); <-- hapus data permanent
	mysql_query("UPDATE user SET
		status_delete = 'Y'
		WHERE id_user =".$_POST['hapus']
	);
}
else {
	// deklarasikan variabel
	$id_user	  = $_POST['id'];
	$nama 	  = ucwords($_POST['nama']);
	$username 	  = $_POST['username'];
	$password 	  = $_POST['password'];
	$id_group 	  = $_POST['id_group'];
	$status_aktif    = $_POST['status_aktif'];
	
	// proses tambah data user
	if($id_user == 0) {
		mysql_query("INSERT INTO user (id_user,nama, username, password, last_login, id_group, status_aktif, status_delete) VALUES('','".$nama."','".$username."','".$password."','','".$id_group."','".$status_aktif."','T')");
	// proses ubah data user
	} else {
		mysql_query("UPDATE user SET 
		nama = '$nama',
		username = '$username',
		password = '$password',
		id_group = '$id_group',
		status_aktif = '$status_aktif'
		WHERE id_user = '$id_user'
		");
	}
}
?>
