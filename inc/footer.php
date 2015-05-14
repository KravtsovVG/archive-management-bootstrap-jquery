<?php
if(@$_GET['logout']){
	?>
	PT. Jamparing Masagi &copy; <?php $copyYear = 2013; $curYear = date('Y'); echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : ''); ?> - All Right Reserved | Best viewed on latest <a href="http://chrome.google.com" target="_BLANK" title="Download Google Chrome">Google Chrome</a>
	<?php
}
elseif(@$_SESSION['admin'] == null){
	?>
	<strong>
		PT. Jamparing Masagi &copy; <?php $copyYear = 2013; $curYear = date('Y'); echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : ''); ?> - All Right Reserved<br />Best viewed on latest <a style="color:white;" href="http://chrome.google.com" target="_BLANK" title="Download Google Chrome">Google Chrome</a>
	</strong>
	<?php
}
else{
	?>
	PT. Jamparing Masagi &copy; <?php $copyYear = 2013; $curYear = date('Y'); echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : ''); ?> - All Right Reserved | Best viewed on latest <a href="http://chrome.google.com" target="_BLANK" title="Download Google Chrome">Google Chrome</a>
	<?php
}
?>