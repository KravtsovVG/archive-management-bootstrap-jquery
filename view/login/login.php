<?php
 	require_once 'api/fungsi.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>JM Archives</title>
		<meta name="Generator" content="Sublime Text">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php require_once 'inc/meta.php' ?>
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="inc/compress/css_compress.login.php" type="text/css" media="screen" />
		<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'> -->
		<script src="js/jquery-1.8.3.min.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
		<div id="login">
			<div class="login_containder" id="login_containder">
				<img src="img/bukuLogin.png" width="300px">
				<form name="login" method="POST">
					<table class="login_bg_input" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td class="title_input">Username</td>
							<td>&nbsp;:</td>
							<td><input type="text" name="uname" id="uname" autofocus></td>
						</tr>
						<tr>
							<td class="title_input">Password</td>
							<td>&nbsp;:</td>
							<td><input type="password" name="pass" id="pass"></td>
						</tr>
						<tr>
							<td colspan="3" class="submit_"><input type="submit" Value="Login" id="submit"></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="footer"><?php require_once 'inc/footer.php' ?></div>
			<p></p>
		</div>
		<div class="copy">Background image by Luoman</div>
	</body>
</html>
