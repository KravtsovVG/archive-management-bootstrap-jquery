<?php
session_start();

require_once '../inc/conf.php';

// if($_GET['username'] == "fajar" && $_GET['password'] == "fajar")
//   echo '{"response":{"error": "1"}}';
// else
//   echo '{"response":{"error": "0"}}';

$username = $_GET['username'];
$password = $_GET['password'];

if(!$query = mysql_query("SELECT username,password,id_group FROM user WHERE username='$username' AND password='$password'")){
	die(mysql_error());
};
$row = mysql_fetch_array($query);
if($row['username']){
	$_SESSION['admin'] = $row['id_group'] . " " . $row['username'];
	$_SESSION['token'] = rand() . "\n" . rand() . "\n" . rand(5, 15);

	$query = "UPDATE user SET last_login = '".date("Y-m-d H:i:s")."' WHERE username = '$username' AND password = '$password'";
		$result=mysql_query($query);
		if ($result) {
			echo '{"response":{"error": "1"}}';
		}
		else{
			echo '{"response":{"error": "0"}}';
		}
}
else{
	echo '{"response":{"error": "0"}}';
}

?>