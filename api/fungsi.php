<?php
include ('inc/conf.php');

/* mulai class db_fungsi */  
class db_fungsi{
	function root(){
		$sql="SELECT * FROM root LIMIT 1";     
		$result=mysql_query($sql);     
		while($rows=mysql_fetch_array($result)){     
			echo $rows['dns_root'];     
		}    
	}
}

$db_fungsi = new db_fungsi();
?>