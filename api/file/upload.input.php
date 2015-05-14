<?php
require_once '../../inc/conf.php';
session_start();

// deklarasikan variabel
if($_POST){
	$id_category_ = $_POST['kategori'];
	$id_category_detail_ = $_POST['subkategori'];
	$judul_ = $_POST['judul_dokumen'];

	$id_category = ucwords($id_category_);
	$id_category_detail =  ucwords($id_category_detail_);
	$judul =  ucwords($judul_);
	
	$username = substr($_SESSION['admin'], 2);
    	if(!$queryname = mysql_query("SELECT nama FROM user WHERE username ='".$username."'")){
        		die(mysql_error());
        	};
        	while($datanama = mysql_fetch_array($queryname)){
		$user = $datanama['nama'];
	}

	$time 	  = date("Y-m-d H:i:s");
	
	// proses tambah data dokumen
	$query = "INSERT INTO document (nama_doc, id_category, id_service_name, datetime, created_by) VALUES ('".($judul==""?"Untitled":$judul)."', '$id_category', '$id_category_detail', '".$time."', '".$user."')";
	$result1 = mysql_query($query);
	
	if (!$result1) {
		echo "save failed";
		die;
	};

	$query = "SELECT id_doc from document where nama_doc = '".($judul==""?"Untitled":$judul)."' and id_category = '$id_category' and id_service_name = '$id_category_detail'  and datetime = '$time' and created_by = '$user'";
	$result2 = mysql_query($query);
	
	if (!$result2) {
		echo "save failed";
		die;
	};
	
	$row = mysql_fetch_array($result2);
	$id_doc = $row['id_doc'];

	//INSERT DATA DOC DETAIL
	$nama_doc_ = $_POST['nama_dokumen'];
	$deskripsi_ = $_POST['deskripsi_dokumen'];
	$lokasi_fis_ = $_POST['lokasi_fisik'];

	$nama_doc = ucwords($nama_doc_);
	$deskripsi = ucwords($deskripsi_);
	$lokasi_fis = ucwords($lokasi_fis_);

	$nama_file = $_FILES['dokumen_file']['name'];
		$query = "INSERT INTO document_detail (id_doc, nama_doc_detail, deskripsi, lokasi_fis, file) VALUES ($id_doc, '".($nama_doc==""?"Untitled":$nama_doc)."', '".($deskripsi==""?"No description":$deskripsi)."', '".($lokasi_fis==""?"No description":$lokasi_fis)."', '".($nama_file==""?"Untitled":$nama_file)."')";
						
		$result3 = mysql_query($query);
		if (!$result3) {
			echo "save failed";
			die;
		};
		
		$fileSize = $_FILES['dokumen_file']['size']; //get the size
		$fileError = $_FILES['dokumen_file']['error']; //get the error when upload
		
		if($fileSize > 0 || $fileError == 0){ //check if the file is corrupt or error
			$move = move_uploaded_file($_FILES['dokumen_file']['tmp_name'], '../../uploads/'.$nama_file); //save image to the folder
			if($move){
				// echo "<em>Upload '$nama_doc ($fileSize bytes)' success ... </em><br/>";
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			else{
				echo "gagal file transfer"; 
			}
		};
};
?>
