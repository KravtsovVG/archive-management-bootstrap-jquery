<?php
require_once 'inc/compress/php_compress_header.php';

	// mulai fungsi-fungsi pendukung
	session_start();

	if((!@$_SESSION['admin']) && (!@$_SESSION['token'])){
		include("view/login/login.php"); 
	}
	else{
		include("view/main.php");
	}

require_once 'inc/compress/php_compress_main.php';
?>