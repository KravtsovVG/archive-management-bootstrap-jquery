<?php
	
	$_SESSION['logout'] = "";
	unset($_SESSION['logout']);
	session_unset("logout");
	session_destroy();

	echo "<p style='margin: 10px;'>Tunggu sebentar, anda akan dialihkan ke halaman login...</p>";
?>
	<script type="text/javascript">
		setTimeout("location.href = '<?php $db_fungsi->root(); ?>';",1500);
	</script>