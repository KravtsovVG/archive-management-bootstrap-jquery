<?php
require_once 'inc/conf.php';
require_once 'api/fungsi.php';
unset($_SESSION['cari']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>IT Service Catalog</title>
		<meta name="Generator" content="Sublime Text">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php require_once 'inc/meta.php' ?>
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="inc/compress/css_compress.bootstrap.php" type="text/css" media="screen" />
		<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'> -->
		<script src="js/jquery-1.8.3.min.js"></script>
		<style type="text/css">
		body {
			background: url('css/img/bg2.jpg') no-repeat center center fixed;
			-webkit-background-size: cover;
  			-moz-background-size: cover;
  			-o-background-size: cover;
  			background-size: cover;
		}
		</style>
	</head>
	<body>
		<?php
			if(isset($_GET['logout'])){
				require_once 'view/login/logout.php';
			}
			else{ 
				require_once 'menu/menu.php';
				if(isset($_GET['tentang'])){
					header('Location: http://'.$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"]).'/tentang/');
				}
				elseif(isset($_GET['cetak'])){
					header('Location: http://'.$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"]).'/cetak/?' . 'k=' . $_GET["k"] . '&s=' . $_GET["s"] . '&param=' . $_GET["param"]);
				}
				elseif(isset($_GET['file'])){
					require_once 'data/file.php';
				}
				elseif(isset($_GET['user'])){
					require_once 'data/user.php';
				}
				elseif(isset($_GET['kategori'])){
					require_once 'data/kategori.php';
				}
				elseif(isset($_GET['subkategori'])){
					require_once 'data/subkategori.php';
				}
				elseif (isset($_GET['pencarian'])){
					if($_GET['pencarian'] == 'user'){
						$pencarian = @$_GET['q'];
						$_SESSION['cari'] = $pencarian;
						require_once 'data/user.php';
					}
					else{
						$pencarian = @$_GET['q'];
						$_SESSION['cari'] = $pencarian;
						require_once 'data/file.php';
					}
				}
				else{
					require_once 'data/main.php';
				}
			}
		?>

		<?php require_once 'api/file/upload.modal.php'; ?>

		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.autocomplete.min.js"></script>

		<!-- main scrip untuk menampilkan modal dialog -->
		<?php
			if(@$_GET['kategori']){
				echo "<script src='js/kategori.js'></script>";
			}
			elseif(@$_GET['subkategori']){
				echo "<script src='js/subkategori.js'></script>";
			}
			else{
				echo "<script src='js/user.js'></script>";
			}
		?>
		<div class="copyright"><?php require_once 'inc/footer.php' ?></div>
	</body>
</html>

